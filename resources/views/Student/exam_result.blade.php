<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Result - {{ $exam->exam_title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ece9e6, #ffffff);
            min-height: 100vh;
        }
        .result-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin: 2rem 0;
        }
        .score-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 2rem;
        }
        .question-result {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .correct-answer { background: #d4edda; border-left: 4px solid #28a745; }
        .incorrect-answer { background: #f8d7da; border-left: 4px solid #dc3545; }
        .option.correct { background: #d4edda; font-weight: 600; }
        .option.incorrect { background: #f8d7da; }
        /* .correct-answer {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }
        .incorrect-answer {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
        } */
        .option {
            padding: 0.5rem;
            margin: 0.25rem 0;
            border-radius: 5px;
        }
        /* .option.correct {
            background: #d4edda;
            font-weight: bold;
        } */
        .option.selected {
            background: #fff3cd;
        }
        /* .option.incorrect {
            background: #f8d7da;
        } */
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-graduation-cap"></i> Exam Result
        </a>
        <div class="navbar-nav ms-auto">
            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm me-2">
                <i class="fas fa-home me-1"></i>Dashboard
            </a>
            <a href="{{ url('/exams') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Back to Exams
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="score-box">
        <h2><i class="fas fa-trophy me-2"></i>Your Score</h2>
        <h1 class="display-4">{{ $attempt->obtained_marks }} / {{ $attempt->total_marks }}</h1>
        <h3>{{ number_format($attempt->percentage, 2) }}%</h3>
        @if($attempt->submitted_at)
            <p class="mt-3 mb-0">
                <i class="fas fa-calendar me-2"></i>Submitted on:
                {{ date('j F Y, g:i A', strtotime($attempt->submitted_at)) }}
            </p>
        @endif
    </div>

    <div class="result-container">
        <h3 class="mb-4">
            <i class="fas fa-clipboard-list me-2"></i>{{ $exam->exam_title }}
        </h3>
        @if($exam->description)
            <p class="text-muted mb-4">{{ $exam->description }}</p>
        @endif

        @foreach((is_array($questions) ? $questions : []) as $index => $question)
            @php
                $studentAnswer = $studentAnswers[$index] ?? null;
                $correctAnswer = $correctAnswers[$index] ?? null;
                $isCorrect = $studentAnswer !== null && $studentAnswer === $correctAnswer;
            @endphp
            <div class="question-result {{ $isCorrect ? 'correct-answer' : 'incorrect-answer' }}">
                <h5 class="mb-3">
                    <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                    {{ $question }}
                </h5>

                @if(isset($options[$index]))
                    <div class="options">
                        @foreach(['A', 'B', 'C', 'D'] as $option)
                            @if(isset($options[$index][$option]) && $options[$index][$option])
                                @php
                                    $isCorrectOption = ($option === $correctAnswer);
                                    $isSelected      = ($option === $studentAnswer);

                                    if ($isCorrect) {
                                        // student sahi: sirf correct option green
                                        $optionClass = $isCorrectOption ? 'correct' : '';
                                    } else {
                                        // student galat: sahi option green, selected galat red
                                        if ($isCorrectOption) {
                                            $optionClass = 'correct';
                                        } elseif ($isSelected) {
                                            $optionClass = 'incorrect';
                                        } else {
                                            $optionClass = '';
                                        }
                                    }
                                @endphp

                                <div class="option {{ $optionClass }}">
                                    <strong>{{ $option }}.</strong> {{ $options[$index][$option] }}

                                    @if($option == $correctAnswers[$index])
                                        {{-- Sirf correct option ke saamne text dikhana hai --}}
                                        <span class="text-success"> ✔ Correct Answer</span>
                                    @endif

                                    @if(!$isCorrect && $isSelected && !$isCorrectOption)
                                        <span class="ms-2 text-danger fw-semibold">
                                            <i class="fas fa-times-circle me-1"></i>Your Answer (Incorrect)
                                        </span>
                                    @endif

                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

            </div>
        @endforeach

        <div class="text-center mt-4">
            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg me-2">
                <i class="fas fa-home me-2"></i>Go to Dashboard
            </a>
            <a href="{{ url('/exams') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Back to Exams
            </a>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>