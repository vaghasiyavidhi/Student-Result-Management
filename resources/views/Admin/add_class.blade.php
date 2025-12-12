@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Class Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Class</li>
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
                <h3 class="card-title">Student Class Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/insert_class')}}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Class Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Section</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Section" name="section">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputCountry1">Academic Year</label>
                    <input type="text" class="form-control" id="exampleInputCountry1" placeholder="Academic Year" name="academic_year">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="save">Submit</button>
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