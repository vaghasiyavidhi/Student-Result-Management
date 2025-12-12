<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free-7.1.0-web/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <style>
    /* Uniform spacing for sidebar icons (icon to label) */
    .nav-sidebar .nav-link > i,
    .nav-sidebar .nav-item .nav-link > i {
      margin-right: .6rem;
      min-width: 1.25rem;;
      text-align: center;
    }

    /* Keep treeview arrows aligned to the right */
    .nav-sidebar .nav-link .right {
      margin-left: .4rem;
      float: right;
    }

    /* Small spacing for header/nav icons */
    .main-header .nav-link > i {
      margin-right: .5rem;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="padding-right: 0px !important;"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{URL('/')}}" class="nav-link">Logout</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button" style="padding-right: 0px !important;">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-primary">
      <span class="brand-text font-weight-light" style="font-size:18px;"><b style="font-size:26px;">SRM</b> AdminPanel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user4-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-capitalize">{{ session('admin_name') }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{URL('/admin/dashboard')}}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
              <i class="fa-solid fa-gauge"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item {{ request()->is('admin/*_class*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/*_class*') ? 'active' : '' }}">
              <i class="fa-solid fa-building-columns"></i>
              <p>
                Student Classes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('/admin/add_class')}}" class="nav-link {{ request()->is('admin/add_class') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL('/admin/manage_class')}}" class="nav-link {{ request()->is('admin/manage_class') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Classes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/*_sub*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/*_sub*') ? 'active' : '' }}">
              <i class="fa-solid fa-layer-group"></i>
              <p>
                Subjects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('/admin/add_sub')}}" class="nav-link {{ request()->is('admin/add_sub') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL('/admin/manage_sub')}}" class="nav-link {{ request()->is('admin/manage_sub') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Subjects</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/*_stud*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/*_stud*') ? 'active' : '' }}">
              <i class="fa-solid fa-users"></i>
              <p>
                Students
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('/admin/add_stud')}}" class="nav-link {{ request()->is('admin/add_stud') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL('/admin/manage_stud')}}" class="nav-link {{ request()->is('admin/manage_stud') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Students</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/*_exam*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/*_exam*') ? 'active' : '' }}">
              <i class="fa-solid fa-clipboard-list"></i>
              <p>
                Exams
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('/admin/add_exam')}}" class="nav-link {{ request()->is('admin/add_exam') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Exams</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL('/admin/manage_exam')}}" class="nav-link {{ request()->is('admin/manage_exam') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Exams</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/*_res*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/*_res*') ? 'active' : '' }}">
              <i class="fa-solid fa-chart-bar"></i>
              <p>
                Result
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('/admin/add_res')}}" class="nav-link {{ request()->is('admin/add_res') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Result</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL('/admin/manage_res')}}" class="nav-link {{ request()->is('admin/manage_res') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Result</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/*_notice*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/*_notice*') ? 'active' : '' }}">
              <i class="fa-solid fa-bell"></i>
              <p>
                Notices
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('/admin/add_notice')}}" class="nav-link {{ request()->is('admin/add_notice') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Notice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL('/admin/manage_notice')}}" class="nav-link {{ request()->is('admin/manage_notice') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Notices</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{URL('/admin/admin_pass')}}" class="nav-link {{ request()->is('admin/admin_pass') ? 'active' : '' }}">
              <i class="fa-solid fa-key"></i>
              <p>
                Admin Change Password
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>