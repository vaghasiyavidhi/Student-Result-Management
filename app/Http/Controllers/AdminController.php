<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\stud_class;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Result;
use App\Models\Notice;
use App\Models\Exam;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    function Login() {
        return view('admin/login');
    }

    function Login_admin(Request $req) {

        $email = $req->email;
        $password = $req->password;

        $admin = Admin::where('email', $email)->first();

        if (!$admin) {
            return back()
                ->withInput($req->only('email'))
                ->with('error', 'Email and password are invalid.');
        }

        if ($admin->password !== $password) {
            return back()
                ->withInput($req->only('email'))
                ->with('error', 'Password is incorrect.');
        }
        
        session(['admin_id' => $admin->id]);
        session(['admin_name' => $admin->name]);

        return redirect('/admin/dashboard')->with('success', 'Login successful.');
    }

    function Dashboard(Request $req) {

        $reg_user = Admin::count();
        $total_subjects = Subject::count();
        $total_classes = stud_class::count();
        $total_results = Result::where('status', 'Declared')->count();
        $dec_results = Result::where('status', 'Declared')->orderBy('created_at', 'desc')->take(10)->get();
        
        return view('admin/dashboard', [
            'reg_user' => $reg_user,
            'total_subjects' => $total_subjects,
            'total_classes' => $total_classes,
            'total_results' => $total_results,
            'dec_results' => $dec_results
        ]);
    }

    function Logout(Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/admin');
    }

    // Class

    function addClass() {
        return view('admin/add_class');
    }

    function insertClass(Request $req){
        $name = $req->name;
        $section = $req->section;
        $academic_year = $req->academic_year;

        $data = array('name'=>$name, 'section'=>$section, 'academic_year'=>$academic_year);
        stud_class::insert($data);
        return redirect('/admin/manage_class');
    }

    function manageClass(){
        $data['data'] = stud_class::orderBy('id', 'desc')->paginate(10);
        return view('admin/manage_class')->with($data);
    }

    function editClass($id) {
        $class = stud_class::find($id);
        if (!$class) {
            return redirect('/admin/manage_class')->with('error', 'Class not found.');
        }
        return view('admin/edit_class', ['class' => $class]);
    }

    function updateClass(Request $req, $id){
        $class = stud_class::find($id);
        if (!$class) {
            return redirect('/admin/manage_class')->with('error', 'Class not found.');
        }

        $class->name = $req->name;
        $class->section = $req->section;
        $class->academic_year = $req->academic_year;
        $class->save();

        return redirect('/admin/manage_class')->with('success', 'Class updated successfully.');
    }

    function deleteClass($id){
        stud_class::destroy($id);
        return redirect('/admin/manage_class')->with('success', 'Class deleted successfully.');
    }
    // Subject 

    function addSubject() {
        $data['subject'] = stud_class::orderBy('name', 'asc')->get();
        return view('admin/add_sub')->with($data);
    }

    function insertSubject(Request $req){
        $sub_code = $req->sub_code;
        $name = $req->name;
        $assign_class = $req->assign_class;

        $data = array('sub_code'=>$sub_code, 'name'=>$name, 'assign_class'=>$assign_class);
        Subject::insert($data);
        return redirect('/admin/manage_sub');
    }

    function manageSubject(){
        $data['data'] = Subject::join('stud_class', 'subject.assign_class', '=', 'stud_class.id')->select('subject.*', 'stud_class.name as class_name', 'stud_class.section')->orderBy('subject.id', 'desc')->paginate(10);
        return view('admin/manage_sub')->with($data);
    }

    function editSubject($id) {
        $subject = Subject::find($id);
        if (!$subject) {
            return redirect('/admin/manage_sub')->with('error', 'Subject not found.');
        }
        $classes = stud_class::orderBy('name', 'asc')->get();
        return view('admin/edit_sub', ['subject' => $subject, 'classes' => $classes]);
    }

    function updateSubject(Request $req, $id){
        $subject = Subject::find($id);
        if (!$subject) {
            return redirect('/admin/manage_sub')->with('error', 'Subject not found.');
        }

        $subject->sub_code = $req->sub_code;
        $subject->name = $req->name;
        $subject->assign_class = $req->assign_class;
        $subject->save();

        return redirect('/admin/manage_sub')->with('success', 'Subject updated successfully.');
    }

    function deleteSubject($id){
        Subject::destroy($id);
        return redirect('/admin/manage_sub')->with('success', 'Subject deleted successfully.');
    }

    // Student

    function addStudent() {
        $data['student'] = stud_class::orderBy('id', 'desc')->get();
        return view('admin/add_stud')->with($data);
    }

    function insertStudent(Request $req){
        $roll_no = $req->roll_no;
        $name = $req->name;
        $class = $req->class;
        $email = $req->email;
        $phone = $req->phone;
        $DOB = $req->DOB;
        $gender = $req->gender;

        $data = array('roll_no'=>$roll_no, 'name'=>$name, 'class'=>$class, 'email'=>$email, 'phone'=>$phone, 'DOB'=>$DOB, 'gender'=>$gender);
        Student::insert($data);
        return redirect('/admin/manage_stud');
    }

    function manageStudent(){
        $data['data'] = Student::join('stud_class', 'student.class', '=', 'stud_class.id')->select('student.*', 'stud_class.name as class_name', 'stud_class.section')->orderBy('student.id', 'desc')->paginate(10);
        return view('admin/manage_stud')->with($data);
    }

    function editStudent($id) {
        $student = Student::find($id);
        if (!$student) {
            return redirect('/admin/manage_stud')->with('error', 'Student not found.');
        }
        $classes = stud_class::orderBy('name', 'asc')->get();
        return view('admin/edit_stud', ['student' => $student, 'classes' => $classes]);
    }

    function updateStudent(Request $req, $id){
        $student = Student::find($id);
        if (!$student) {
            return redirect('/admin/manage_stud')->with('error', 'Student not found.');
        }

        $student->roll_no = $req->roll_no;
        $student->name = $req->name;
        $student->class = $req->class;
        $student->email = $req->email;
        $student->phone = $req->phone;
        $student->DOB = $req->DOB;
        $student->gender = $req->gender;
        $student->save();

        return redirect('/admin/manage_stud')->with('success', 'Student updated successfully.');
    }

    function deleteStudent($id){
        Student::destroy($id);
        return redirect('/admin/manage_stud')->with('success', 'Student deleted successfully.');
    }

    // Exam

    function addExam() {
        $subjects = Subject::orderBy('name', 'asc')->get();
        $examTitles = $this->getExamTitleOptions();
        $classList = stud_class::orderBy('name', 'asc')->get();
        return view('admin/add_exam', [
            'subjects' => $subjects,
            'examTitles' => $examTitles,
            'classList' => $classList,
        ]);
    }

    public function fetchStudents(Request $request)
    {
        $students = Student::where('class_id', $request->class_id)->get(['id','name','roll_no']);
        return response()->json($students);
    }

    // student -> subjects (maan ke chal rahe hain subjects table me class_id hai)
    public function fetchSubjects(Request $request)
    {
        $subjects = Subject::where('class_id', $request->class_id)->get(['id','subject_name', 'subject_code']);
        return response()->json($subjects);
    }

    function insertExam(Request $req){
        $validated = $req->validate([
            'subject_name' => ['required', 'string'],
            'class_section' => ['required', 'string'],
            'exam_title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'integer', 'min:1'],
            'questions' => ['required', 'array'],
            'questions.*.question_text' => ['required', 'string'],
            'questions.*.option_a' => ['required', 'string'],
            'questions.*.option_b' => ['required', 'string'],
            'questions.*.option_c' => ['nullable', 'string'],
            'questions.*.option_d' => ['nullable', 'string'],
            'questions.*.correct_answer' => ['required', 'string', 'in:A,B,C,D'],
            'questions.*.marks' => ['required', 'integer', 'min:1'],
        ]);

        // Prepare questions data
        $questions = [];
        $options = [];
        $correctAnswers = [];
        $marks = [];
        $totalMarks = 0;

        foreach ($validated['questions'] as $index => $question) {
            $questions[] = $question['question_text'];
            $options[] = [
                'A' => $question['option_a'],
                'B' => $question['option_b'],
                'C' => $question['option_c'] ?? null,
                'D' => $question['option_d'] ?? null,
            ];
            $correctAnswers[] = $question['correct_answer'];
            $marks[] = $question['marks'];
            $totalMarks += $question['marks'];
        }

        Exam::create([
            'subject_name' => $validated['subject_name'],
            'class_section' => $validated['class_section'],
            'exam_title' => $validated['exam_title'],
            'description' => $validated['description'],
            'duration_minutes' => $validated['duration'],
            'questions' => json_encode($questions),
            'options' => json_encode($options),
            'correct_answer' => json_encode($correctAnswers),
            'marks' => json_encode($marks),
            'status' => 'active',
        ]);

        return redirect('/admin/manage_exam')->with('success', 'Exam added successfully.');
    }

    function manageExam(){
        $data['data'] = Exam::orderBy('id', 'desc')->paginate(10);
        return view('admin/manage_exam')->with($data);
    }
    
    function editExam($id) 
    {
        $exam = Exam::find($id);
        if (!$exam) {
            return redirect('/admin/manage_exam')->with('error', 'Exam not found.');
        }

        $subjects   = Subject::orderBy('name', 'asc')->get();
        $examTitles = $this->getExamTitleOptions();
        $classList  = stud_class::orderBy('name', 'asc')->get();

        // JSON fields ko array me convert karo
        $questions = json_decode($exam->questions ?? '[]', true) ?? [];
        $options   = json_decode($exam->options ?? '[]', true) ?? [];
        $marks     = json_decode($exam->marks ?? '[]', true) ?? [];
        $correct   = json_decode($exam->correct_answer ?? '[]', true) ?? [];

        return view('admin.edit_exam', [
            'exam'       => $exam,
            'subjects'   => $subjects,
            'examTitles' => $examTitles,
            'classList'  => $classList,
            'questions'  => $questions,
            'options'    => $options,
            'marks'      => $marks,
            'correct'    => $correct,
        ]);
    }    
    
    function updateExam(Request $req, $id){
        $exam = Exam::find($id);
        if (!$exam) {
            return redirect('/admin/manage_exam')->with('error', 'Exam not found.');
        }
        
        $validated = $req->validate([
            'subject_name' => ['required', 'string'],
            'class_section' => ['required', 'string'],
            'exam_title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'integer', 'min:1'],
            'questions' => ['nullable', 'array'],
            'questions.*.question_text' => ['required_with:questions', 'string'],
            'questions.*.option_a' => ['required_with:questions', 'string'],
            'questions.*.option_b' => ['required_with:questions', 'string'],
            'questions.*.option_c' => ['nullable', 'string'],
            'questions.*.option_d' => ['nullable', 'string'],
            'questions.*.correct_answer' => ['required_with:questions', 'string', 'in:A,B,C,D'],
            'questions.*.marks' => ['required_with:questions', 'integer', 'min:1'],
        ]);

        $exam->subject_name = $validated['subject_name'];
        $exam->class_section = $validated['class_section']; 
        $exam->exam_title = $validated['exam_title'];
        $exam->description = $validated['description'];
        $exam->duration_minutes = $validated['duration'];

        // Update questions if provided
        if (isset($validated['questions']) && count($validated['questions']) > 0) {
            $questions = [];
            $options = [];
            $correctAnswers = [];
            $marks = [];

            foreach ($validated['questions'] as $index => $question) {
                $questions[] = $question['question_text'];
                $options[] = [
                    'A' => $question['option_a'],
                    'B' => $question['option_b'],
                    'C' => $question['option_c'] ?? null,
                    'D' => $question['option_d'] ?? null,
                ];
                $correctAnswers[] = $question['correct_answer'];
                $marks[] = $question['marks'];
            }

            $exam->questions = json_encode($questions);
            $exam->options = json_encode($options);
            $exam->correct_answer = json_encode($correctAnswers);
            $exam->marks = json_encode($marks);
        }

        $exam->save();

        return redirect('/admin/manage_exam')->with('success', 'Exam updated successfully.');
    }

    private function getExamTitleOptions(): array
    {
        return [
            'Unit Test',
            'Monthly Test',
            'Quarterly Examination',
            'Half-Yearly Examination',
            'Pre-Final Examination',
            'Final Examination',
        ];
    }

    function deleteExam($id){
        Exam::destroy($id);
        return redirect('/admin/manage_exam')->with('success', 'Exam deleted successfully.');
    }

    // Result

    function addResult() {
        $data['students'] = Student::orderBy('name', 'asc')->get();
        $data['classes'] = stud_class::orderBy('id', 'desc')->get();
        return view('admin/add_res')->with($data);
    }

    function insertResult(Request $req){
        $classId = $req->class;
        $studId = $req->stud_id;
        
        // Get student and class details
        $student = Student::find($studId);
        $class = stud_class::find($classId);
        
        if (!$student || !$class) {
            return redirect('/admin/add_res')->with('error', 'Invalid student or class selected.');
        }
        
        // Get all subjects data
        $subjects = $req->subjects;
        
        if (!$subjects || !is_array($subjects)) {
            return redirect('/admin/add_res')->with('error', 'Please enter marks for at least one subject.');
        }

        $subjectNames = [];
        $subjectMarks = [];

        foreach ($subjects as $subjectData) {
            $subjectName = $subjectData['subject_name'] ?? null;
            $markObtained = $subjectData['mark_obtained'] ?? null;

            if ($subjectName && $markObtained !== null && trim($markObtained) !== '') {
                $subjectNames[] = (string) $subjectName;
                $subjectMarks[] = (string) $markObtained;
            }
        }

        if (empty($subjectNames)) {
            return redirect('/admin/add_res')->with('error', 'Please enter marks for at least one subject.');
        }

        Result::create([
            'roll_no' => (string) $student->roll_no,
            'stud_name' => (string) $student->name,
            'class_name' => (string) ($class->name . ' - ' . $class->section),
            'subject_name' => implode(', ', $subjectNames),
            'mark_obtained' => implode(', ', $subjectMarks),
            'status' => $req->status == 1 ? 'Declared' : 'Pending',
        ]);

        return redirect('/admin/manage_res')->with('success', 'Result added successfully.');
    }

    function manageResult(){
        $data['data'] = Result::orderBy('id', 'desc')->paginate(10);
        return view('admin/manage_res')->with($data);
    }

    function editResult($id) {
        $result = Result::find($id);
        if (!$result) {
            return redirect('/admin/manage_res')->with('error', 'Result not found.');
        }

        // Find the student associated with the result
        $student = Student::where('roll_no', $result->roll_no)->first();
        if (!$student) {
            return redirect('/admin/manage_res')->with('error', 'Associated student not found.');
        }

        // Prepare subjects and marks for the view
        $subjectNames = explode(', ', $result->subject_name);
        $subjectMarks = explode(', ', $result->mark_obtained);
        $subjectsData = [];
        for ($i = 0; $i < count($subjectNames); $i++) {
            $subjectsData[] = [
                'name' => $subjectNames[$i],
                'marks' => $subjectMarks[$i] ?? ''
            ];
        }

        return view('admin/edit_res', [
            'result' => $result,
            'student' => $student,
            'subjectsData' => $subjectsData
        ]);
    }

    function updateResult(Request $req, $id){
        $result = Result::find($id);
        if (!$result) {
            return redirect('/admin/manage_res')->with('error', 'Result not found.');
        }

        $subjects = $req->subjects;
        $subjectNames = array_column($subjects, 'subject_name');
        $subjectMarks = array_column($subjects, 'mark_obtained');

        $result->subject_name = implode(', ', $subjectNames);
        $result->mark_obtained = implode(', ', $subjectMarks);
        $result->status = $req->status == 1 ? 'Declared' : 'Pending';
        $result->save();

        return redirect('/admin/manage_res')->with('success', 'Result updated successfully.');
    }

    function deleteResult($id){
        Result::destroy($id);
        return redirect('/admin/manage_res')->with('success', 'Result deleted successfully.');
    }

    // Add these new methods
    function getStudentsByClass($classId) {
        // Convert to string to match database field type
        $students = Student::where('class', (string)$classId)->orderBy('name', 'asc')->get();
        
        // Debug: Log the query
        Log::info('Fetching students for class: ' . $classId);
        Log::info('Students found: ' . $students->count());
        
        return response()->json($students);
    }

    function getSubjectsByClass($classId) {
        // Convert to string to match database field type
        $subjects = Subject::where('assign_class', (string)$classId)->orderBy('name', 'asc')->get();
        
        // Debug: Log the query
        Log::info('Fetching subjects for class: ' . $classId);
        Log::info('Subjects found: ' . $subjects->count());
        
        return response()->json($subjects);
    }

    function getNextRollNumber($classId) {
        // Get all roll numbers for the selected class
        $students = Student::where('class', (string)$classId)
            ->select('roll_no')
            ->get();
        
        $maxRollNo = 0;
        
        // Find the maximum numeric roll number
        foreach ($students as $student) {
            // Try to convert roll_no to integer, if it's numeric
            $rollNo = (int)$student->roll_no;
            if ($rollNo > $maxRollNo) {
                $maxRollNo = $rollNo;
            }
        }
        
        // If no students exist in this class, start with 1, otherwise increment
        $nextRollNo = $maxRollNo + 1;
        
        return response()->json(['roll_no' => (string)$nextRollNo]);
    }

    // Notice

    function addNotice() {
        return view('admin/add_notice');
    }

    function insertNotice(Request $req){
        $title = $req->title;
        $description = $req->description;
        $issue_date = $req->issue_date;
        $expiry_date = $req->expiry_date;
        $status = $req->status;

        $data = array('title'=>$title, 'description'=>$description, 'issue_date'=>$issue_date, 'expiry_date'=>$expiry_date, 'status'=>$status);
        Notice::insert($data);
        return redirect('/admin/manage_notice');
    }

    function manageNotice(){
        $data['data'] = Notice::orderBy('id', 'desc')->paginate(10);
        return view('admin/manage_notice')->with($data);
    }

    function editNotice($id) {
        $notice = Notice::find($id);
        if (!$notice) {
            return redirect('/admin/manage_notice')->with('error', 'Notice not found.');
        }
        return view('admin/edit_notice', ['notice' => $notice]);
    }

    function updateNotice(Request $req, $id){
        $notice = Notice::find($id);
        if (!$notice) {
            return redirect('/admin/manage_notice')->with('error', 'Notice not found.');
        }

        $notice->title = $req->title;
        $notice->description = $req->description;
        $notice->issue_date = $req->issue_date;
        $notice->expiry_date = $req->expiry_date;
        $notice->status = $req->status;
        $notice->save();

        return redirect('/admin/manage_notice')->with('success', 'Notice updated successfully.');
    }

    function deleteNotice($id){
        Notice::destroy($id);
        return redirect('/admin/manage_notice')->with('success', 'Notice deleted successfully.');
    }

    // Admin Password

    function adminPass() {
        return view('admin/admin_pass');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:4', 'confirmed'],
        ]);

        $adminId = $request->session()->get('admin_id');
        $admin = Admin::findOrFail($adminId);

        // Simple plain-text comparison
        if ($request->old_password !== $admin->password) {
            return redirect('/admin/admin_pass')
                ->with('error', 'Current password is incorrect.');
        }

        if ($request->new_password === $admin->password) {
            return redirect('/admin/admin_pass')
                ->with('error', 'New password must be different from the current password.');
        }

        $admin->password = $request->new_password; // Stored as-is
        $admin->save();

        return redirect('/admin/admin_pass')
            ->with('success', 'Password updated successfully.');
    }
}
