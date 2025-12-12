@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Result</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{URL('/admin/manage_res')}}">Manage Results</a></li>
              <li class="breadcrumb-item active">Edit Result</li>
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
                <h3 class="card-title">Edit Result Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/edit_res/'.$result->id)}}">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" class="form-control" value="{{ $result->stud_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <input type="text" class="form-control" value="{{ $result->class_name }}" readonly>
                    </div>

                    <hr>
                    <h5>Subjects and Marks</h5>
                    
                    @foreach($subjectsData as $index => $subject)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subject Name</label>
                                <input type="text" class="form-control" name="subjects[{{$index}}][subject_name]" value="{{ $subject['name'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mark Obtained</label>
                                <input type="text" class="form-control" name="subjects[{{$index}}][mark_obtained]" value="{{ $subject['marks'] }}" placeholder="Enter marks" required>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" id="status" name="status">
                          <option value="1" {{ ($result->status == 'Declared' || $result->status == 1) ? 'selected' : '' }}>Declared</option>
                          <option value="0" {{ ($result->status == 'Pending' || $result->status == 0) ? 'selected' : '' }}>Pending</option>
                      </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Result</button>
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