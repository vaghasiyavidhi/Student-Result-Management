@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Student</li>
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
                <h3 class="card-title">Student Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/insert_stud')}}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="roll_no">Roll No</label>
                          <input type="text" class="form-control" id="roll_no" placeholder="Select Class to Auto-generate" name="roll_no" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="name">Student Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Student Name" name="name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Class / Section</label>
                          <select class="form-control" name="class" id="class_select">
                          <option value="" disabled selected>Choose Class</option>
                          @foreach($student as $class)
                              <option value="{{$class->id}}">{{$class->name}} - {{$class->section}}</option>
                          @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="phone">Phone Number</label>
                          <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone">
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="DOB">DOB</label>
                            <input type="date" class="form-control" id="DOB" name="DOB">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male">
                                <label class="form-check-label" for="gender_male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female">
                                <label class="form-check-label" for="gender_female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_other" value="Other">
                                <label class="form-check-label" for="gender_other">Other</label>
                            </div>
                        </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const classSelect = document.getElementById('class_select');
    const rollNoInput = document.getElementById('roll_no');

    classSelect.addEventListener('change', function() {
        const classId = this.value;
        
        if (classId) {
            // Fetch next roll number for the selected class
            fetch(`/admin/get-next-roll-number/${classId}`)
                .then(response => response.json())
                .then(data => {
                    rollNoInput.value = data.roll_no;
                })
                .catch(error => {
                    console.error('Error fetching roll number:', error);
                    rollNoInput.value = '';
                });
        } else {
            rollNoInput.value = '';
        }
    });
});
</script>

@include('admin/footer')