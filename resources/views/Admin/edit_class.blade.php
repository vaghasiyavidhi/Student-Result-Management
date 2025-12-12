@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Student Class</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{URL('/admin/manage_class')}}">Manage Classes</a></li>
              <li class="breadcrumb-item active">Edit Class</li>
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
                <h3 class="card-title">Edit Class Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/edit_class/'.$class->id)}}">
                @CSRF
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Class Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $class->name }}">
                  </div>
                  <div class="form-group">
                    <label for="section">Section</label>
                    <input type="text" class="form-control" id="section" placeholder="Section" name="section" value="{{ $class->section }}">
                  </div>
                  <div class="form-group">
                    <label for="academic_year">Academic Year</label>
                    <input type="text" class="form-control" id="academic_year" placeholder="Academic Year" name="academic_year" value="{{ $class->academic_year }}">
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