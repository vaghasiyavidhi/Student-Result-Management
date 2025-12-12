<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Exam - {{ $exam->exam_title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ece9e6, #ffffff);
            min-height: 100vh;
        }
        .exam-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin: 2rem 0;
        }
        .timer-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 2rem;
        }
        .question-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background: #f8f9fa;
        }
        .option-label {
            display: block;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .option-label:hover {
            border-color: #007bff;
            background: #e7f3ff;
        }
        .option-label input[type="radio"]:checked + span {
            font-weight: bold;
            color: #007bff;
        }
        .option-label input[type="radio"] {
            margin-right: 0.5rem;
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
            <i class="fas fa-graduation-cap"></i> {{ $exam->exam_title }}
        </a>
        <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">
                <i class="fas fa-user me-1"></i>{{ session('student_name', 'Guest') }}
            </span>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="timer-box">
        <h4><i class="fas fa-clock me-2"></i>Time Remaining</h4>
        <h2 id="timer">00:00</h2>
    </div>

    <form id="examForm" action="{{ url('/exam/submit/'.$exam->id) }}" method="POST">
        @csrf
        <div class="exam-container">
            <div class="mb-4">
                <h3><i class="fas fa-book me-2"></i>{{ $exam->subject_name }}</h3>
                <p class="text-muted">{{ $exam->description }}</p>
            </div>

            @foreach((is_array($questions) ? $questions : []) as $index => $question)
                <div class="question-card">
                    <h5 class="mb-3">
                        <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                        {{ $question }}
                        <span class="badge bg-info ms-2">{{ $marks[$index] ?? 0 }} marks</span>
                    </h5>

                    @if(isset($options[$index]))
                        <div class="options">
                            @foreach(['A', 'B', 'C', 'D'] as $option)
                                @if(isset($options[$index][$option]) && $options[$index][$option])
                                    <label class="option-label">
                                        <input 
                                            type="radio" 
                                            name="answers[{{ $index }}]" 
                                            value="{{ $option }}"
                                            @if(isset($attempt) && isset($attempt->answers[$index]) && $attempt->answers[$index] === $option)
                                                checked
                                            @endif
                                        >
                                        <span><strong>{{ $option }}.</strong> {{ $options[$index][$option] }}</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg px-5"
                        onclick="return confirm('Are you sure you want to submit the exam? You cannot change your answers after submission.');">
                    <i class="fas fa-check-circle me-2"></i>Submit Exam
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Exam duration in minutes from DB
    const durationMinutes = {{ $exam->duration_minutes ?? 60 }};
    const totalDurationSeconds = durationMinutes * 60;

    // PHP se started_at safely calculate karo
    @php
        // attempt ho bhi sakta hai, nahi bhi
        if (isset($attempt) && $attempt && $attempt->started_at) {
            $startedAtMs = $attempt->started_at->timestamp * 1000;
        } else {
            $startedAtMs = now()->timestamp * 1000;
        }
    @endphp

    const startedAtMs = {{ $startedAtMs }};
    const totalDuration = totalDurationSeconds;

    function calculateRemainingTime() {
        const nowMs = Date.now();
        const elapsedSeconds = Math.floor((nowMs - startedAtMs) / 1000);

        if (elapsedSeconds < 0) {
            // clock issue, treat as just started
            return totalDuration;
        }

        return Math.max(0, totalDuration - elapsedSeconds);
    }

    let totalSeconds = calculateRemainingTime();

    function updateTimer() {
        totalSeconds = calculateRemainingTime();

        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        document.getElementById('timer').textContent =
            String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            alert('Time is up! Submitting exam automatically.');
            document.getElementById('examForm').submit();
        }
    }

    // Init timer
    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>