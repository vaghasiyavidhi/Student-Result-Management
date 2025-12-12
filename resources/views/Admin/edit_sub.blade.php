@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subject</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{URL('/admin/manage_sub')}}">Manage Subjects</a></li>
              <li class="breadcrumb-item active">Edit Subject</li>
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
                <h3 class="card-title">Edit Subject Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/edit_sub/'.$subject->id)}}">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label for="sub_code">Subject Code</label>
                        <input type="text" class="form-control" id="sub_code" placeholder="Subject Code" name="sub_code" value="{{ $subject->sub_code }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Subject Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Subject Name" name="name" value="{{ $subject->name }}">
                    </div>
                    <div class="form-group">
                        <label>Assign Class</label>
                        <select class="form-control" name="assign_class">
                        <option value="" disabled>Choose Class</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" {{ $subject->assign_class == $class->id ? 'selected' : '' }}>{{$class->name}} - {{$class->section}}</option>
                        @endforeach
                        </select>
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