<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .hero {
            text-align: center;
            padding: 300px 20px 200px; /* Increased padding for more height */
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2rem;
        }
        .features {
            padding: 40px 20px;
        }
        .features .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .features .card:hover {
            transform: translateY(-10px);
        }
        .features {
            background-color: black;
            padding: 20px;
        }
    </style>
</head>
<body>
    @include('student/header')

    <div class="hero">
        <h1>Welcome to the Student Portal</h1>
        <p>Your one-stop destination for managing student information and results.</p>
    </div>

    <section class="features">
        <div class="container features">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card p-4">
                        <i class="fas fa-user-graduate fa-3x mb-3 text-primary"></i>
                        <h5>Student Profiles</h5>
                        <p>View and manage student details with ease.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <i class="fas fa-chart-line fa-3x mb-3 text-success"></i>
                        <h5>Performance Tracking</h5>
                        <p>Analyze student performance and progress.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <i class="fas fa-cogs fa-3x mb-3 text-warning"></i>
                        <h5>Admin Tools</h5>
                        <p>Access powerful tools for managing the portal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>