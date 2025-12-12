@include('admin/header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Exam</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{URL('/admin/manage_exam')}}">Manage Exams</a></li>
              <li class="breadcrumb-item active">Edit Exam</li>
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
                <h3 class="card-title">Edit Exam Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{URL('/admin/edit_exam/'.$exam->id)}}">
                @CSRF
                <div class="card-body">
                  <div class="form-group">
                    <label for="subject_name">Subject Name</label>
                    <select class="form-control" id="subject_name" name="subject_name" required>
                      <option value="" disabled {{ old('subject_name"') ? '' : 'selected' }}>Select subject</option>
                      @if(isset($subjects) && count($subjects))
                        @foreach($subjects as $subject)
                          <option value="{{ $subject->name }}" {{ $subject->name === old('subject_name', $exam->subject_name ?? '') ? 'selected' : '' }}>
                            {{ $subject->name }}
                          </option>
                        @endforeach
                      @else
                        <option value="" disabled>No subjects available</option>
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="subject_name">Class / Section</label>
                    <select class="form-control" name="class_section" id="class_section" required>
                        <option value="" disabled>Choose Class</option>
                        @foreach($classList as $cls)
                            @php $val = $cls->name.' - '.$cls->section; @endphp
                            <option value="{{ $val }}" {{ $exam->class_section === $val ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exam_title">Exam Title</label>
                    <select class="form-control" id="exam_title" name="exam_title" required>
                      <option value="" disabled {{ old('exam_title') ? '' : 'selected' }}>Select exam title</option>
                      @if(isset($examTitles) && count($examTitles))
                        @foreach($examTitles as $title)
                          <option value="{{ $title }}" {{ $title === old('exam_title', $exam->exam_title ?? $exam->name) ? 'selected' : '' }}>
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
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Short description" required>{{ old('description', $exam->description) }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="duration">Duration (minutes)</label>
                    <input type="number" class="form-control" id="duration" placeholder="Duration in minutes" name="duration" min="1" value="{{ old('duration', $exam->duration_minutes) }}" required>
                  </div>

                  <hr>

                  <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Questions</h4>
                    <button type="button" id="add-question" class="btn btn-success btn-sm">Add Question</button>
                  </div>

                  <div id="questions-container" class="mt-3">
                    @if(isset($questions) && count($questions))
                        @foreach($questions as $index => $qText)
                            @php
                                $opts   = $options[$index]  ?? ['A'=>null,'B'=>null,'C'=>null,'D'=>null];
                                $corr   = $correct[$index]  ?? null;
                                $qMarks = $marks[$index]    ?? 1;
                            @endphp

                            <div class="question-block border p-3 mb-3" data-question-id="{{ $index }}">
                                <div class="d-flex justify-content-between">
                                    <h5>Question {{ $index + 1 }}</h5>
                                    <button type="button"
                                            class="btn btn-danger btn-sm remove-question"
                                            data-question-id="{{ $index }}">
                                        Remove
                                    </button>
                                </div>

                                <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $index }}">

                                <div class="form-group">
                                    <label>Question Text</label>
                                    <input type="text"
                                          name="questions[{{ $index }}][question_text]"
                                          class="form-control"
                                          value="{{ old('questions.'.$index.'.question_text', $qText) }}"
                                          required>
                                </div>

                                <div class="form-group">
                                    <label>Options</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text">A</span>
                                                <input type="text"
                                                      name="questions[{{ $index }}][option_a]"
                                                      class="form-control"
                                                      value="{{ old('questions.'.$index.'.option_a', $opts['A']) }}"
                                                      required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text">B</span>
                                                <input type="text"
                                                      name="questions[{{ $index }}][option_b]"
                                                      class="form-control"
                                                      value="{{ old('questions.'.$index.'.option_b', $opts['B']) }}"
                                                      required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text">C</span>
                                                <input type="text"
                                                      name="questions[{{ $index }}][option_c]"
                                                      class="form-control"
                                                      value="{{ old('questions.'.$index.'.option_c', $opts['C']) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text">D</span>
                                                <input type="text"
                                                      name="questions[{{ $index }}][option_d]"
                                                      class="form-control"
                                                      value="{{ old('questions.'.$index.'.option_d', $opts['D']) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Correct Answer</label>
                                    <select name="questions[{{ $index }}][correct_answer]"
                                            class="form-control" required>
                                         <option value="" disabled {{ old('correct_answer') ? '' : 'selected' }}>Select Correct Answer</option>
                                        @foreach(['A','B','C','D'] as $optKey)
                                            <option value="{{ $optKey }}"
                                                {{ old('questions.'.$index.'.correct_answer', $corr) === $optKey ? 'selected' : '' }}>
                                                Option {{ $optKey }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Marks</label>
                                    <input type="number"
                                          name="questions[{{ $index }}][marks]"
                                          class="form-control"
                                          min="1"
                                          value="{{ old('questions.'.$index.'.marks', $qMarks) }}"
                                          required>
                                </div>
                            </div>
                        @endforeach
                    @endif
                  </div>

                  <div id="deleted-questions"></div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>

              <div id="question-template" style="display: none;">
                <div class="question-block border p-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <h5>New Question</h5>
                        <button type="button" class="btn btn-danger btn-sm remove-question">Remove</button>
                    </div>

                    <div class="form-group">
                        <label>Question Text</label>
                        <input type="text"
                              name="questions[__INDEX__][question_text]"
                              class="form-control"
                              required>
                    </div>

                    <div class="form-group">
                        <label>Options</label>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">A</span>
                                    <input type="text"
                                          name="questions[__INDEX__][option_a]"
                                          class="form-control"
                                          required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">B</span>
                                    <input type="text"
                                          name="questions[__INDEX__][option_b]"
                                          class="form-control"
                                          required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">C</span>
                                    <input type="text"
                                          name="questions[__INDEX__][option_c]"
                                          class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">D</span>
                                    <input type="text"
                                          name="questions[__INDEX__][option_d]"
                                          class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Correct Answer</label>
                        <select name="questions[__INDEX__][correct_answer]"
                                class="form-control" required>
                            <option value="">Select Correct Answer</option>
                            <option value="A">Option A</option>
                            <option value="B">Option B</option>
                            <option value="C">Option C</option>
                            <option value="D">Option D</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Marks</label>
                        <input type="number"
                              name="questions[__INDEX__][marks]"
                              class="form-control"
                              min="1"
                              required>
                    </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@include('admin/footer')

<script>
document.addEventListener('DOMContentLoaded', function () {
    let questionIndex = {{ isset($questions) ? count($questions) : 0 }};

    document.getElementById('add-question').addEventListener('click', function () {
        const template = document.getElementById('question-template').innerHTML;
        const wrapper  = document.createElement('div');
        wrapper.innerHTML = template.replace(/__INDEX__/g, questionIndex);

        document.getElementById('questions-container')
            .appendChild(wrapper.firstElementChild);

        questionIndex++;
    });

    document.getElementById('questions-container').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-question')) {
            const block = e.target.closest('.question-block');
            const qId   = block.dataset.questionId;

            if (qId !== undefined && qId !== null && qId !== '') {
                const deletedInput = document.createElement('input');
                deletedInput.type  = 'hidden';
                deletedInput.name  = 'deleted_questions[]';
                deletedInput.value = qId;
                document.getElementById('deleted-questions')
                    .appendChild(deletedInput);
            }
            block.remove();
        }
    });
});
</script>
