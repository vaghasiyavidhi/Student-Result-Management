<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Exams</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ece9e6, #ffffff);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .exam-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease-in-out;
            background-color: #fff;
            border-left: 4px solid #007bff;
        }
        .exam-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            border-left-color: #0056b3;
        }
        .exam-header {
            background: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        footer {
            background-color: #343a40;
            color: white;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-graduation-cap"></i> Student Portal
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm me-2">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-5 mb-5">
    <div class="exam-header text-center">
        <h1><i class="fas fa-book-open me-2"></i>Available Exams</h1>
        <p class="lead">Select an exam to begin</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- In-Progress Exams --}}
    @if($inProgressExams->count() > 0)
        <div class="mb-4">
            <h4 class="mb-3">
                <i class="fas fa-hourglass-half me-2 text-warning"></i>Exams In Progress
            </h4>
            <div class="row">
                @foreach($inProgressExams as $exam)
                    @php
                        $attempt = \App\Models\ExamAttempt::where('exam_id', $exam->id)
                            ->where('student_id', session('student_id'))
                            ->where('status', 'in_progress')
                            ->latest()
                            ->first();
                    @endphp
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card exam-card h-100" style="border-left-color:#ffc107;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-clipboard-list me-2"></i>{{ $exam->exam_title }}
                                </h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-book me-1"></i>{{ $exam->subject_name }}
                                </p>
                                @if($attempt && $attempt->started_at)
                                    <p class="text-muted mb-2 small">
                                        <i class="fas fa-calendar me-1"></i>
                                        Started: {{ date('M d, Y', strtotime($attempt->started_at)) }}
                                    </p>
                                @endif
                                <a href="{{ url('/exam/take/'.$exam->id) }}" class="btn btn-warning w-100">
                                    <i class="fas fa-play me-2"></i>Continue Exam
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Available Exams --}}
    @if($availableExams->count() > 0)
        <div class="mb-4">
            <h4 class="mb-3">
                <i class="fas fa-book-open me-2 text-primary"></i>Available Exams
            </h4>
            <div class="row">
                @foreach($availableExams as $exam)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card exam-card h-100">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-clipboard-list me-2"></i>{{ $exam->exam_title }}
                                </h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-book me-1"></i>{{ $exam->subject_name }}
                                </p>
                                @if($exam->description)
                                    <p class="card-text small text-muted mb-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        {{ Str::limit($exam->description, 100) }}
                                    </p>
                                @endif
                                @if($exam->duration_minutes)
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-clock me-1"></i>
                                        Duration: {{ $exam->duration_minutes }} minutes
                                    </p>
                                @endif
                                @if($exam->question_count > 0)
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-question-circle me-1"></i>
                                        {{ $exam->question_count }} Questions
                                    </p>
                                @endif
                                <a href="{{ url('/exam/take/'.$exam->id) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-play me-2"></i>Start Exam
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Completed Exams --}}
    @if($completedExams->count() > 0)
        <div class="mb-4">
            <h4 class="mb-3">
                <i class="fas fa-check-circle me-2 text-success"></i>Completed Exams
            </h4>
            <div class="row">
                @foreach($completedExams as $exam)
                    @php
                        $attempt = \App\Models\ExamAttempt::where('exam_id', $exam->id)
                            ->where('student_id', session('student_id'))
                            ->whereIn('status', ['completed','Pass','Fail'])
                            ->latest()
                            ->first();
                    @endphp
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card exam-card h-100" style="border-left-color:#28a745;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-clipboard-list me-2"></i>{{ $exam->exam_title }}
                                </h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-book me-1"></i>{{ $exam->subject_name }}
                                </p>
                                @if($attempt)
                                    <p class="mb-2">
                                        <strong>{{ $attempt->obtained_marks }}/{{ $attempt->total_marks }}</strong>
                                        <span class="badge bg-success ms-2">
                                            {{ number_format($attempt->percentage, 2) }}%
                                        </span>
                                    </p>
                                @endif
                                @if($attempt && $attempt->submitted_at)
                                    <p class="text-muted mb-3 small">
                                        <i class="fas fa-calendar me-1"></i>
                                        Completed: {{ date('M d, Y', strtotime($attempt->submitted_at)) }}
                                    </p>
                                @endif
                                @if($attempt)
                                    <a href="{{ url('/exam/result/'.$attempt->id) }}" class="btn btn-success w-100">
                                        <i class="fas fa-eye me-2"></i>View Results
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- No exams --}}
    @if($availableExams->count() == 0 &&
        $inProgressExams->count() == 0 &&
        $completedExams->count() == 0)
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">No exams available at the moment.</p>
            </div>
        </div>
    @endif
</main>

<footer class="text-center py-4 mt-auto">
    <p>&copy; {{ date('Y') }} Student Result Management. All Rights Reserved.</p>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>