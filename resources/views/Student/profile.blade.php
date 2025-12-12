<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>

    {{-- Bootstrap & Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ece9e6, #ffffff);
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="px-4 py-4 text-white"
                         style="background: linear-gradient(135deg,#4e73df,#1cc88a);">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                                     style="width:80px;height:80px;">
                                    <span class="text-primary fw-bold fs-3">
                                        {{ strtoupper(substr($student->name,0,1)) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <h3 class="mb-1">{{ $student->name }}</h3>
                                <div class="small">
                                    Roll No:
                                    <span class="fw-semibold">{{ $student->roll_no }}</span> |
                                    Class / Section:
                                    <span class="fw-semibold">
                                        {{ $student->classInfo->full_name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-4 py-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-uppercase text-muted small mb-1">
                                    <i class="fa-solid fa-envelope me-1"></i>Email
                                </h6>
                                <p class="mb-0 fw-semibold">{{ $student->email }}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-uppercase text-muted small mb-1">
                                    <i class="fa-solid fa-phone me-1"></i>Phone
                                </h6>
                                <p class="mb-0 fw-semibold">{{ $student->phone }}</p>
                            </div>

                            @php 
                                use Carbon\Carbon;
                            @endphp

                            <div class="col-md-4">
                                <h6 class="text-uppercase text-muted small mb-1">Date of Birth</h6>
                                <p class="mb-0">{{ Carbon::parse($student->DOB)->format('d/m/Y') }}</p>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-uppercase text-muted small mb-1">Gender</h6>
                                <p class="mb-0">{{ $student->gender }}</p>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-uppercase text-muted small mb-1">Registration Date</h6>
                                <p class="mb-0">{{ $student->created_at }}</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">
                                ← Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>