<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease-in-out;
            background-color: #fff;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }
        .card-icon {
            font-size: 3.5rem;
            transition: color 0.3s ease;
        }
        .card-title {
            font-weight: bold;
            font-size: 1.25rem;
        }
        .card-link {
            text-decoration: none;
            color: inherit;
        }
        .card-profile .card-icon { color: #007bff; }
        .card-results .card-icon { color: #28a745; }
        .card-exams .card-icon { color: #ffc107; }

        .card-link:hover .card-profile { border-top: 5px solid #007bff; }
        .card-link:hover .card-results { border-top: 5px solid #28a745; }
        .card-link:hover .card-exams { border-top: 5px solid #ffc107; }

        .dashboard-header {
            background: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .main-content {
            flex: 1;
        }
        footer {
            background-color: #343a40;
            color: white;
        }
        .recent-exams-section {
            margin-top: 3rem;
        }
        .exam-card {
            border-left: 4px solid #ffc107;
            transition: all 0.3s ease;
        }
        .exam-card:hover {
            border-left-color: #ff9800;
            transform: translateX(5px);
        }
        .exam-date {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .exam-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .section-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #343a40;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item">
                            <a href="{{ url('/') }}" class="btn btn-secondary btn-sm me-2">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5 main-content">
        <div class="dashboard-header text-center">
            <h1>Welcome to Your Dashboard</h1>
            <p class="lead">Access your profile, results, and exam information.</p>
            <a href="{{ url('exam/attempts') }}" class="btn btn-outline-primary">
                View Exam Attempts
            </a>
        </div>

        

        <div class="row">
            <!-- Student Profile Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ url('/profile') }}" class="card-link">
                    <div class="card h-100 card-profile">
                        <div class="card-body text-center">
                            <div class="card-icon mb-3">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h5 class="card-title">Student Profile</h5>
                            <p class="card-text text-muted">View and manage your profile details.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Results Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ url('/result') }}" class="card-link">
                    <div class="card h-100 card-results">
                        <div class="card-body text-center">
                            <div class="card-icon mb-3">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h5 class="card-title">View Results</h5>
                            <p class="card-text text-muted">Check your academic performance and results.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Exams Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ url('/exams') }}" class="card-link">
                    <div class="card h-100 card-exams">
                        <div class="card-body text-center">
                            <div class="card-icon mb-3">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h5 class="card-title">Exams</h5>
                            <p class="card-text text-muted">View exam schedules and details.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        
    </main>

    <footer class="text-center py-4 mt-auto">
        <p>&copy; {{ date('Y') }} Student Result Management. All Rights Reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>