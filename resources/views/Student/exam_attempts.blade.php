<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Attempts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body { background:#f5f5f5; font-family:'Poppins',sans-serif; }
        .attempt-card{
            background:#fff;
            border-radius:12px;
            padding:1.25rem;
            margin-bottom:1rem;
            box-shadow:0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
<div class="container mt-4 mb-4">
    <h1 class="mb-4">Exam Attempts</h1>

    @if($attempts->isEmpty())
        <p class="text-muted">No exam attempts found.</p>
    @else
        @foreach($attempts as $attempt)
            <div class="attempt-card">
                <h5>
                    <strong>Exam:</strong>
                    {{ $attempt->exam->subject_name ?? 'N/A' }} ({{ $attempt->exam->exam_title ?? 'N/A' }})
                </h5>
                <p>
                    <strong>Total Marks:</strong> {{ $attempt->total_marks }}
                    &nbsp; | &nbsp;
                    <strong>Obtained Marks:</strong> {{ $attempt->obtained_marks }}
                </p>
                <p>
                    <strong>Percentage:</strong> {{ number_format($attempt->percentage,2) }}%
                    &nbsp; | &nbsp;
                    <strong>Status:</strong> {{ $attempt->status }}
                </p>
                <p>
                    <strong>Submitted At:</strong>
                    @if($attempt->submitted_at)
                        {{ date('F d, Y h:i A', strtotime($attempt->submitted_at)) }}
                    @else
                        N/A
                    @endif
                </p>
                <a href="{{ url('/exam/result/'.$attempt->id) }}"
                   class="btn btn-primary btn-sm">
                    View Result
                </a>
            </div>
        @endforeach
    @endif

    <a href="{{ url('/dashboard') }}" class="btn btn-secondary mt-2">
        Back to Dashboard
    </a>
</div>
</body>
</html>