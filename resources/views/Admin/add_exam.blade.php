@include('admin/header')

<style>
  #fab-add-question {
      position: fixed !important;
      right: 30px !important;
      bottom: 80px !important;
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2000;
  }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exam Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Exam</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Exam Form</h3>
              </div>

              <form method="POST" action="{{URL('/admin/insert_exam')}}" enctype="multipart/form-data">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                          <label for="class_section">Class / Section</label>
                          <select class="form-control" name="class" id="classSelect">
                          <option value="" disabled selected>Choose Class</option>
                          @foreach($classList as $class)
                              <option value="{{$class->id}}">{{$class->name}} - {{$class->section}}</option>
                          @endforeach
                          </select>
                      </div>
                 
                      <div class="form-group">
                          <label>Student</label>
                          <select class="form-control" name="stud_id" id="studentSelect">
                            <option value="" disabled selected>Choose Student</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label>Subject</label>
                          <select class="form-control" name="subject_name" id="subjectSelect">
                            <option value="" disabled selected>Choose Subject</option>
                          </select>
                      </div>
                   <div class="form-group">
                     <label for="exam_title">Exam Title</label>
                     <select class="form-control" id="exam_title" name="exam_title" required>
                      <option value="" disabled {{ old('exam_title') ? '' : 'selected' }}>Select exam title</option>
                       @if(isset($examTitles) && count($examTitles))
                         @foreach($examTitles as $title)
                           <option value="{{ $title }}" {{ old('exam_title') === $title ? 'selected' : '' }}>
                             {{ $title }}
                           </option>
                         @endforeach
                       @else
                         <option value="" disabled>No exam titles configured</option>
                       @endif
                     </select>
                   </div>

                   <div class="form-group">
                     <label for="description">Description</label>
                     <textarea class="form-control" id="description" name="description" rows="4" placeholder="Short description" required>{{ old('description') }}</textarea>
                   </div>

                   <div class="form-group">
                     <label for="duration">Duration (minutes)</label>
                     <input type="number" class="form-control" id="duration" placeholder="Duration in minutes" name="duration" min="1" value="{{ old('duration') }}" required>
                   </div>

                   <hr>

                   <div class="d-flex justify-content-between align-items-center mb-3">
                     <h3 class="card-title">Questions</h3>
                   </div>

                   <div id="questions-container">
                      <div class="question-block card card-outline card-secondary p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <h5>Question 1</h5>
                            <button type="button" class="btn btn-danger btn-sm remove-question-btn">&times;</button>
                        </div>
                        <div class="form-group">
                            <label for="questions[0][question_text]">Question</label>
                            <textarea class="form-control" name="questions[0][question_text]" rows="3" placeholder="Enter question" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="questions[0][option_a]">Option A</label>
                                <input type="text" class="form-control" name="questions[0][option_a]" placeholder="Enter option A" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="questions[0][option_b]">Option B</label>
                                <input type="text" class="form-control" name="questions[0][option_b]" placeholder="Enter option B" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="questions[0][option_c]">Option C</label>
                                <input type="text" class="form-control" name="questions[0][option_c]" placeholder="Enter option C">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="questions[0][option_d]">Option D</label>
                                <input type="text" class="form-control" name="questions[0][option_d]" placeholder="Enter option D">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="questions[0][correct_answer]">Correct Answer</label>
                                <select class="form-control" name="questions[0][correct_answer]" required>
                                    <option value="" disabled {{ old('correct_answer') ? '' : 'selected' }}>Select correct option</option>
                                    <option value="A">Option A</option>
                                    <option value="B">Option B</option>
                                    <option value="C">Option C</option>
                                    <option value="D">Option D</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="questions[0][marks]">Marks</label>
                                <input type="number" class="form-control" name="questions[0][marks]" min="1" placeholder="Marks allotted" required>
                            </div>
                        </div>
                      </div>
                   </div>

                 </div>

                 <div class="card-footer">
                   <button type="submit" class="btn btn-primary" name="save">Create Exam</button>
                 </div>
               </form>
            </div>
        </div>
      </div>
      </div>
    </section>
</div>

{{-- Floating + button bottom-right --}}
<button type="button"
        id="fab-add-question"
        class="btn btn-primary rounded-circle shadow">
    <span style="font-size:24px; line-height:1;">+</span>
</button>

@include('admin/footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    let selectedClassId = null;
    let selectedStudentId = null;

    // 1) Class -> Students
    $('#classSelect').on('change', function() {
        selectedClassId = $(this).val();
        selectedStudentId = null;

        $('#studentSelect').html('<option value="" disabled selected>Loading students...</option>');
        $('#subjectSelect').html('<option value="" disabled selected>Choose Subject</option>');

        if (!selectedClassId) return;

        $.ajax({
            url: '/admin/get-students-by-class/' + selectedClassId,
            type: 'GET',
            dataType: 'json',
            success: function(students) {
                if (students && students.length) {
                    let html = '<option value="" disabled selected>Choose Student</option>';
                    $.each(students, function(i, s) {
                        html += '<option value="'+s.id+'">'+s.name+' ('+s.roll_no+')</option>';
                    });
                    $('#studentSelect').html(html);
                } else {
                    $('#studentSelect').html('<option value="" disabled selected>No students found</option>');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Error loading students');
            }
        });
    });

    // 2) Student -> Subjects (for selected class)
    $('#studentSelect').on('change', function() {
        selectedStudentId = $(this).val();

        $('#subjectSelect').html('<option value="" disabled selected>Loading subjects...</option>');

        if (!selectedClassId || !selectedStudentId) {
            $('#subjectSelect').html('<option value="" disabled selected>Please select class & student</option>');
            return;
        }

        $.ajax({
            url: '/admin/get-subjects-by-class/' + selectedClassId,
            type: 'GET',
            dataType: 'json',
            success: function(subjects) {
                if (subjects && subjects.length) {
                    let html = '<option value="" disabled selected>Choose Subject</option>';
                    $.each(subjects, function(i, sub) {
                        // value me subject name ya id jo tum insertExam me expect karte ho
                        html += '<option value="'+ sub.name +'">'+ sub.name +' ('+ sub.sub_code +')</option>';
                    });
                    $('#subjectSelect').html(html);
                } else {
                    $('#subjectSelect').html('<option value="" disabled selected>No subjects for this class</option>');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Error loading subjects');
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let questionIndex = 1; // first question already present
    const fabAddQuestion = document.getElementById('fab-add-question');
    const questionsContainer = document.getElementById('questions-container');

    const handleRemoveQuestion = (e) => {
        if (e.target.classList.contains('remove-question-btn')) {
            e.target.closest('.question-block').remove();
        }
    };

    fabAddQuestion.addEventListener('click', function() {
        const idx = questionIndex;

        const block = document.createElement('div');
        block.className = 'question-block card card-outline card-secondary p-3 mb-3';
        block.innerHTML = `
            <div class="d-flex justify-content-between">
                <h5>Question ${idx + 1}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-question-btn">&times;</button>
            </div>
            <div class="form-group">
                <label for="questions[${idx}][question_text]">Question</label>
                <textarea class="form-control" name="questions[${idx}][question_text]" rows="3" placeholder="Enter question" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="questions[${idx}][option_a]">Option A</label>
                    <input type="text" class="form-control" name="questions[${idx}][option_a]" placeholder="Enter option A" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="questions[${idx}][option_b]">Option B</label>
                    <input type="text" class="form-control" name="questions[${idx}][option_b]" placeholder="Enter option B" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="questions[${idx}][option_c]">Option C</label>
                    <input type="text" class="form-control" name="questions[${idx}][option_c]" placeholder="Enter option C">
                </div>
                <div class="col-md-6 form-group">
                    <label for="questions[${idx}][option_d]">Option D</label>
                    <input type="text" class="form-control" name="questions[${idx}][option_d]" placeholder="Enter option D">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="questions[${idx}][correct_answer]">Correct Answer</label>
                    <select class="form-control" name="questions[${idx}][correct_answer]" required>
                        <option value="">Select correct option</option>
                        <option value="A">Option A</option>
                        <option value="B">Option B</option>
                        <option value="C">Option C</option>
                        <option value="D">Option D</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="questions[${idx}][marks]">Marks</label>
                    <input type="number" class="form-control" name="questions[${idx}][marks]" min="1" placeholder="Marks allotted" required>
                </div>
            </div>
        `;
        questionsContainer.appendChild(block);
        questionIndex++;
    });

    questionsContainer.addEventListener('click', handleRemoveQuestion);
});
</script>