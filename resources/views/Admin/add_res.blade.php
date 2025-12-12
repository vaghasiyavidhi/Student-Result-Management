@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Result</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Result</li>
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
                <h3 class="card-title">Result Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/insert_res')}}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id">
                <div class="card-body">
                  <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                          <label>Class</label>
                          <select class="form-control" name="class" id="classSelect">
                          <option value="" disabled selected>Choose Class</option>
                          @foreach($classes as $class)
                              <option value="{{$class->id}}">{{$class->name}} - {{$class->section}}</option>
                          @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                          <label>Student</label>
                          <select class="form-control" name="stud_id" id="studentSelect">
                          <option value="" disabled selected>Choose Student</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-12" id="subjectsContainer">
                      <div class="form-group">
                          <label>Subjects</label>
                          <div id="subjectsList">
                              <p class="text-muted">Please select a class and student to load subjects.</p>
                          </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Declared</option>
                        <option value="0">Pending</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="save">Declare Result</button>
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

<script>
$(document).ready(function() {
    var selectedClassId = null;
    var selectedStudentId = null;

    // When class is selected, load students for that class
    $('#classSelect').on('change', function() {
        selectedClassId = $(this).val();
        selectedStudentId = null;
        
        // Reset student dropdown
        $('#studentSelect').html('<option value="" disabled selected>Choose Student</option>');
        
        // Clear subjects
        $('#subjectsList').html('<p class="text-muted">Please select a student to load subjects.</p>');
        
        if (selectedClassId) {
            // Load students for selected class
            $.ajax({
                url: '/admin/get-students-by-class/' + selectedClassId,
                type: 'GET',
                dataType: 'json',
                success: function(students) {
                    console.log('Students loaded:', students);
                    if (students && students.length > 0) {
                        $.each(students, function(index, student) {
                            $('#studentSelect').append(
                                '<option value="' + student.id + '">' + 
                                student.name + ' (' + student.roll_no + ')' + 
                                '</option>'
                            );
                        });
                    } else {
                        $('#studentSelect').html('<option value="" disabled selected>No students found for this class</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading students:', error);
                    console.error('Response:', xhr.responseText);
                    alert('Error loading students. Please try again.');
                }
            });
        }
    });

    // When student is selected, load subjects for the selected class
    $('#studentSelect').on('change', function() {
        selectedStudentId = $(this).val();
        
        console.log('Student selected:', selectedStudentId);
        console.log('Class ID:', selectedClassId);
        
        if (selectedClassId && selectedStudentId) {
            // Load subjects for selected class
            $.ajax({
                url: '/admin/get-subjects-by-class/' + selectedClassId,
                type: 'GET',
                dataType: 'json',
                success: function(subjects) {
                    console.log('Subjects loaded:', subjects);
                    if (subjects && subjects.length > 0) {
                        var subjectsHtml = '<div class="row">';
                        $.each(subjects, function(index, subject) {
                            subjectsHtml += '<div class="col-md-6 mb-3">';
                            subjectsHtml += '<label>' + subject.name + ' (Code: ' + subject.sub_code + ')</label>';
                            subjectsHtml += '<input type="hidden" name="subjects[' + index + '][subject_id]" value="' + subject.id + '">';
                            subjectsHtml += '<input type="hidden" name="subjects[' + index + '][subject_name]" value="' + subject.name + '">';
                            subjectsHtml += '<input type="text" class="form-control" name="subjects[' + index + '][mark_obtained]" placeholder="Enter marks" min="0" max="100" required>';
                            subjectsHtml += '</div>';
                        });
                        subjectsHtml += '</div>';
                        $('#subjectsList').html(subjectsHtml);
                    } else {
                        $('#subjectsList').html('<p class="text-danger">No subjects found for this class.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading subjects:', error);
                    console.error('Response:', xhr.responseText);
                    console.error('Status:', status);
                    alert('Error loading subjects. Please check console for details.');
                }
            });
        } else {
            $('#subjectsList').html('<p class="text-muted">Please select a class and student to load subjects.</p>');
        }
    });
});
</script>