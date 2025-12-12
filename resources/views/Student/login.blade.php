<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<style>
    body {
      font-family: 'Source Sans Pro', sans-serif;
    }
    .login-box {
      margin: 5% auto;
      width: 400px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      overflow: hidden;
    }
    .login-logo a {
      color: #fff;
      font-size: 2rem;
      font-weight: bold;
    }
    .card {
      border: none;
      border-radius: 10px;
    }
    .card-body {
      background: #fff;
      padding: 20px;
    }
    .btn-primary {
      background: #6a11cb;
      border: none;
      transition: background 0.3s;
    }
    .btn-primary:hover {
      background: #2575fc;
    }
    .form-control {
      border-radius: 5px;
      border: 1px solid #ddd;
    }
    .input-group-text {
      background: #f0f0f0;
      border: 1px solid #ddd;
    }
  </style>
<div class="login-box">
  <div class="login-logo">
    <a>Student</a><span>Login</span>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="POST" action="{{URL('/login')}}">
        @CSRF
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Roll Number" name="roll_no" value="{{ old('roll_no') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-control" name="class">
            <option value="" disabled {{ old('class') ? '' : 'selected' }}>Select Class</option>
            @foreach($classes as $class)
            <option value="{{ $class->id }}" {{ old('class') == $class->id ? 'selected' : '' }}>
              {{ $class->name }} - {{ $class->section }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
