@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{URL('/admin/manage_stud')}}">Manage Students</a></li>
              <li class="breadcrumb-item active">Edit Student</li>
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
                <h3 class="card-title">Edit Student Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/edit_stud/'.$student->id)}}">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label for="roll_no">Roll No</label>
                        <input type="text" class="form-control" id="roll_no" placeholder="Roll No" name="roll_no" value="{{ $student->roll_no }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Student Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Student Name" name="name" value="{{ $student->name }}">
                    </div>
                    <div class="form-group">
                        <label>Assign Class</label>
                        <select class="form-control" name="class">
                        <option value="" disabled>Choose Class</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" {{ $student->class == $class->id ? 'selected' : '' }}>{{$class->name}} - {{$class->section}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $student->email }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" value="{{ $student->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="DOB">Date of Birth</label>
                        <input type="date" class="form-control" id="DOB" name="DOB" value="{{ $student->DOB }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" class="form-control" id="gender" placeholder="Gender" name="gender" value="{{ $student->gender }}">
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