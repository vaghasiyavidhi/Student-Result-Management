<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Result</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    @media print {
      .no-print {
        display: none !important;
      }
      body {
        -webkit-print-color-adjust: exact; /* Chrome, Safari */
        color-adjust: exact; /* Firefox */
      }
      .card-header {
        background-color: #0d6efd !important;
        color: white !important;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="container pt-4 pb-4">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="d-flex justify-content-end mb-3 no-print">
          <a href="{{ url('/dashboard') }}" class="btn btn-secondary me-2">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
          </a>
          <button onclick="window.print()" class="btn btn-info">
            <i class="fas fa-download"></i> Download Result
          </button>
        </div>
        <div class="card shadow" id="result-card">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Result Summary</h4>
          </div>
          <div class="card-body">
            <div class="mb-4">
              <h5 class="fw-bold">{{ $student->name }}</h5>
              <p class="mb-1">Roll No: <strong>{{ $student->roll_no }}</strong></p>
              <p class="mb-1">Email: <strong>{{ $student->email }}</strong></p>
              <p class="mb-0">Class / Section: <strong>{{ $student->classInfo->full_name }}</strong></p>
            </div>

            @if(!$result)
              <div class="alert alert-info">
                Results are not declared yet. Please check back later.
              </div>
            @else
                @php
                  $subjects = array_map('trim', explode(',', $result->subject_name ?? ''));
                  $marks = array_map('trim', explode(',', $result->mark_obtained ?? ''));
                  $status = ucfirst(strtolower($result->status ?? 'Declared'));
                  $badgeClass = match ($status) {
                    'Declared' => 'bg-success',
                    'Pending' => 'bg-warning text-dark',
                    'Cancelled' => 'bg-danger',
                    default => 'bg-secondary',
                  };

                  $totalMarksObtained = 0;
                  $totalMaximumMarks = 0;
                  $validMarksCount = 0;
                  $resultStatus = 'Pass';
                  $passingMark = 33;

                  foreach ($marks as $mark) {
                      if (is_numeric($mark)) {
                          $totalMarksObtained += (int)$mark;
                          $validMarksCount++;
                          if ((int)$mark < $passingMark) {
                            $resultStatus = 'Fail';
                          }
                      } else {
                        $resultStatus = 'Fail';
                      }
                  }


                  $totalMaximumMarks = $validMarksCount * 100;
                  $percentage = $totalMaximumMarks > 0 ? ($totalMarksObtained / $totalMaximumMarks) * 100 : 0;

                  $grade = match (true) {
                      $percentage >= 90 => 'A+',
                      $percentage >= 80 => 'A',
                      $percentage >= 70 => 'B',
                      $percentage >= 60 => 'C',
                      default => 'F',
                  };

                  $gradeExclamation = match ($grade) {
                      'A+' => 'Excellent',
                      'A' => 'Very Good',
                      'B' => 'Good',
                      'C' => 'Satisfactory',
                      'F' => 'Needs Improvement',
                      default => '',
                  };

                  if ($grade === 'F') {
                    $resultStatus = 'Fail';
                  }

                @endphp
                <div class="mb-4 border rounded p-3">
                  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                      <h5 class="mb-0">{{ $result->class_name }}</h5>
                      <small class="text-muted">Declared on {{ optional($result->created_at)->format('d M Y, h:i A') }}</small>
                    </div>
                    <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                  </div>
                  <div class="table-responsive mt-3">
                    <table class="table table-striped mb-0">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th class="text-end">Marks Obtained</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($subjects as $index => $subject)
                          @continue($subject === '')
                          <tr>
                            <td>{{ $subject }}</td>
                            <td class="text-end">{{ $marks[$index] ?? '-' }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="2" class="text-center">No subject data available.</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <div class="mt-3">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th>Total Marks Obtained</th>
                          <td class="text-end fw-bold">{{ $totalMarksObtained }} / {{ $totalMaximumMarks }}</td>
                        </tr>
                        <tr>
                          <th>Percentage</th>
                          <td class="text-end fw-bold">{{ number_format($percentage, 2) }}%</td>
                        </tr>
                        <tr>
                          <th>Grade</th>
                          <td class="text-end fw-bold">{{ $grade }} - ({{ $gradeExclamation }})</td>
                        </tr>
                        <tr>
                          <th>Result Status</th>
                          <td class="text-end fw-bold">
                            <span class="badge {{ $resultStatus === 'Pass' ? 'bg-success' : 'bg-danger' }}">
                              {{ $resultStatus }}
                            </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
