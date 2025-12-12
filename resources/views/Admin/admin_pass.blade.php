@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Admin Password</h3>
              </div>
              <!-- /.card-header -->

              {{-- Display Success, Error, and Validation Messages --}}
              @if (session('success'))
                  <div class="alert alert-success m-3">
                      {{ session('success') }}
                  </div>
              @endif
              @if (session('error'))
                  <div class="alert alert-danger m-3">
                      {{ session('error') }}
                  </div>
              @endif

              <!-- form start -->
              <form method="POST" action="{{ URL('/admin/admin_pass') }}">
                @CSRF
                <div class="card-body">
                  <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="Enter Old Password" name="old_password">
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="Enter New Password" name="new_password">
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm New Password" name="new_password_confirmation">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@include('admin/footer')