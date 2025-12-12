<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use App\Models\stud_class;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Js;

class StudentController extends Controller
{
    public function Home()
    {
        return view('student/home');
    }

    // public function Login()
    // {
    //     return view('student/login');
    // }

    // public function Login_student(Request $request)
    // {
    //     // simple demo: email se student fetch karo, session me id save karo
    //     $student = Student::where('email', $request->email)->firstOrFail();
    //     session(['student_id' => $student->id]);

    //     return redirect('/dashboard');
    // }

    public function Login()
    {
        $classes = stud_class::orderBy('name', 'asc')->orderBy('section', 'asc')->get();
        return view('student/login', [
            'classes' => $classes,
        ]);
    }

    public function Login_student(Request $request)
    {
        $request->validate([
            'roll_no' => ['required', 'string'],
            'class' => ['required'],
        ]);

        $student = Student::where('roll_no', $request->roll_no)
            ->where('class', $request->class)
            ->first();

        if (!$student) {
            return back()
                ->withInput($request->only('roll_no'))
                ->with('error', 'Roll number or class is invalid.');
        }

        session([
            'student_id' => $student->id,
            'student_name' => $student->name,
            'student_roll_no' => $student->roll_no,
        ]);

        return redirect('/dashboard');

        // $results = Result::where('roll_no', $student->roll_no)
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        // $latestResult = $results->first();

        // if (!$latestResult || $latestResult->status === 'Pending' || $latestResult->status == 0) {
        //     return back()
        //         ->with('error', 'Result not declared yet. Please check back later.');
        // }

        // $classDetails = stud_class::find($student->class);
        
        // return view('student/dashboard', [
        //     'student' => $student,
        //     'results' => $results,
        //     'classDisplayName' => $classDetails ? $classDetails->name . ' - ' . $classDetails->section : 'N/A',
        // ]);
    }

    public function Result(Request $request)
    {
        // Login student
        // $studentId = session('student_id');   // ya auth('student')->id()
        // $student   = Student::with('classInfo')->findOrFail($studentId);

        // // Class name/section
        // $class     = stud_class::find($student->class_id);

        // // Sirf is student ke declared results
        // $results = Result::where('id', $studentId)
        //             ->orderByDesc('created_at')
        //             ->get();

        // return view('student.result', compact('student', 'results'));

        $studentId = session('student_id');                 // login ke waqt set
        $student   = Student::with('classInfo')->findOrFail($studentId);
        // $attempt = ExamAttempt::where('student_id', $studentId)
        // ->latest('submitted_at')
        // ->first();

        $result = Result::where('roll_no', $student->roll_no)
            ->where('class_name', $student->classInfo->full_name)   // ya ->where('class_name', $student->class_name)
            ->orderByDesc('created_at')
            ->first();   // ho sakta hai null

        return view('Student.result', [
            'student' => $student,
            'result'  => $result,
            // 'attempt' => $attempt,
        ]);
    }

    public function Dashboard()
    {
        // Yahan pe tum jis tarah login kar rahe ho, us se student ka id lo
        // Agar users table se login ho raha hai:
        // $user = auth()->user();               // logged‑in user
        // $student = Student::where('email', $user->email)->first(); // ya direct Student::find(session('student_id'))

        if (!session()->has('student_id')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $student = Student::with('classInfo')->findOrFail(session('student_id'));

        // Stats
        $totalExams    = Exam::count();
        $totalAttempts = ExamAttempt::where('student_id', $student->id)->count();
        $passedCount   = ExamAttempt::where('student_id', $student->id)
                            ->where('status', 'Pass')
                            ->count();

        return view('Student.dashboard', [
            'student'       => $student,
            'totalExams'    => $totalExams,
            'totalAttempts' => $totalAttempts,
            'passedCount'   => $passedCount,
        ]);
    }

    public function Profile()
    {
        if (!session()->has('student_id')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $student = Student::with('classInfo')->findOrFail(session('student_id'));   // admin students table wali model

        return view('student/profile', compact('student'));
    }

    public function Exams()
    {
        $studentId = session('student_id');

        // 1) Logged-in student + uska class_section
        $student = Student::with('classInfo')->findOrFail($studentId);
        $classSection = $student->classInfo->full_name;   // e.g. "First - A"

        // 2) Sirf is class_section ke active exams lao
        $exams = Exam::where('status', 'Active')
                    ->where('class_section', $classSection)
                    ->get();

        // 3) Teen collections banao
        $inProgressExams = collect();
        $completedExams  = collect();
        $availableExams  = collect();

        foreach ($exams as $exam) {
            $attempt = ExamAttempt::where('exam_id', $exam->id)
                        ->where('student_id', $studentId)
                        ->latest()
                        ->first();

            if ($attempt && $attempt->status === 'in_progress') {
                $inProgressExams->push($exam);
            } elseif ($attempt && in_array($attempt->status, ['completed', 'Pass', 'Fail'])) {
                $completedExams->push($exam);
            } else {
                $availableExams->push($exam);
            }
        }

        return view('student/exams', compact(
            'availableExams',
            'inProgressExams',
            'completedExams',
            'student',
            'exams'
        ));
    }

    public function takeExam($id)
    {
        $exam = Exam::findOrFail($id);

        if ($exam->status !== 'active') {
            return redirect('/exams')->with('error', 'This exam is not available.');
        }

        // 2) Login check + student id lo
        if (!session()->has('student_id')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $studentId   = session('student_id');
        $student     = Student::findOrFail($studentId);
        $studentName = $student->name;

        // 3) Check: kya ye exam pehle complete kar chuka hai?
        $completedAttempt = ExamAttempt::where('exam_id', $id)
            ->where('student_id', $studentId)
            ->whereIn('status', ['completed', 'Pass', 'Fail'])
            ->latest()
            ->first();

        if ($completedAttempt) {
            return redirect('/exam/result/' . $completedAttempt->id)
                ->with('info', 'You have already completed this exam. Here are your results.');
        }

        // 4) In‑progress attempt lao ya naya banao
        $attempt = ExamAttempt::where('exam_id', $id)
            ->where('student_id', $studentId)
            ->where('status', 'in_progress')
            ->first();

        if (!$attempt) {
            // Naya attempt
            $attempt = ExamAttempt::create([
                'exam_id'        => $id,
                'student_id'     => $studentId,
                'student_name'   => $studentName ?? null, // sirf tab agar column ho
                'status'         => 'in_progress',
                'started_at'     => now(),
                'total_marks'    => 0,
                'obtained_marks' => 0,
                'percentage'     => 0,
                'answers'        => json_encode([]),
            ]);
        } else {
            // Purana attempt hai, started_at null ho to ab set karo
            if (!$attempt->started_at) {
                $attempt->started_at = now();
                $attempt->save();
            }
        }

        // 5) Exam ke JSON fields ko array me convert karo (backup ke saath)
        $questions = is_array($exam->questions)
            ? $exam->questions
            : (json_decode($exam->questions, true) ?? []);

        $options = is_array($exam->options)
            ? $exam->options
            : (json_decode($exam->options, true) ?? []);

        $marks = is_array($exam->marks)
            ? $exam->marks
            : (json_decode($exam->marks, true) ?? []);

        // 6) View ko data bhejo
        return view('Student.take_exam', [
            'exam'     => $exam,
            'questions'=> $exam->questions_array,   // accessor se safe array
            'options'  => $options,
            'marks'    => $marks,
            'attempt'  => $attempt,
        ]);
    }

    public function submitExam(Request $request, $id)
    {
        // // 1) Exam without with()
        // $exam = Exam::findOrFail($id);

        // // 2) Current student id (session se)
        // $studentId = session('student_id');

        // // 3) Form se answers array
        // $answers = $request->input('answers', []);

        // // 4) Exam ke questions / marks arrays
        // $questions = $exam->questions_array;                    // accessor
        // $marksArr  = is_array($exam->marks)
        //     ? $exam->marks
        //     : (json_decode($exam->marks, true) ?? []);

        // $totalMarks = array_sum($marksArr);
        // $score      = 0;

        // // 5) Correct answers array
        // $correctArr = is_array($exam->correct_answer)
        //     ? $exam->correct_answer
        //     : (json_decode($exam->correct_answer, true) ?? []);

        // foreach ($questions as $index => $qText) {
        //     $given  = $answers[$index] ?? null;
        //     $right  = $correctArr[$index] ?? null;
        //     $qMarks = $marksArr[$index] ?? 1;

        //     if ($given !== null && $given === $right) {
        //         $score += $qMarks;
        //     }
        // }

        // $percentage = $totalMarks > 0 ? ($score / $totalMarks) * 100 : 0;
        // $status     = $percentage >= 40 ? 'Pass' : 'Fail'; // rule customise karo

        // // 6) Attempt row update/create
        // $attempt = ExamAttempt::where('exam_id', $id)
        //     ->where('student_id', $studentId)
        //     ->where('status', 'in_progress')
        //     ->first();

        // if (!$attempt) {
        //     $attempt = new ExamAttempt();
        //     $attempt->exam_id    = $id;
        //     $attempt->student_id = $studentId;
        //     $attempt->started_at = now();
        // }

        // // yahan ADD karo: answers ko JSON me save karo
        // $attempt->answers        = json_encode($answers);
        // $attempt->total_marks    = $totalMarks;
        // $attempt->obtained_marks = $score;
        // $attempt->percentage     = $percentage;
        // $attempt->status         = 'completed';
        // $attempt->answers        = json_encode($answers);    
        // $attempt->submitted_at   = now();
        // $attempt->save();



        // return redirect('/exam/result/'.$attempt->id)
        //     ->with('success', 'Exam submitted successfully.');

        $exam = Exam::findOrFail($id);

        $studentId = session('student_id');
        $answers   = $request->input('answers', []);

        $questions = $exam->questions_array;

        $marksArr  = is_array($exam->marks)
            ? $exam->marks
            : (json_decode($exam->marks, true) ?? []);

        $totalMarks = array_sum($marksArr);
        $score      = 0;

        $correctArr = is_array($exam->correct_answer)
            ? $exam->correct_answer
            : (json_decode($exam->correct_answer, true) ?? []);

        foreach ($questions as $index => $qText) {
            $given  = $answers[$index] ?? null;
            $right  = $correctArr[$index] ?? null;
            $qMarks = $marksArr[$index] ?? 1;

            if ($given !== null && $given === $right) {
                $score += $qMarks;
            }
        }

        $percentage = $totalMarks > 0 ? ($score / $totalMarks) * 100 : 0;

        // grade + result status (yehi 1st page ke hisab se use karo)
        $grade = match (true) {
            $percentage >= 90 => 'A+',
            $percentage >= 80 => 'A',
            $percentage >= 70 => 'B',
            $percentage >= 60 => 'C',
            $percentage >= 50 => 'D',
            default           => 'F',
        };

        $resultStatus = $percentage >= 40 && $grade !== 'F' ? 'Pass' : 'Fail';

        // Attempt row
        $attempt = ExamAttempt::where('exam_id', $id)
            ->where('student_id', $studentId)
            ->where('status', 'in_progress')
            ->first();

        if (!$attempt) {
            $attempt = new ExamAttempt();
            $attempt->exam_id    = $id;
            $attempt->student_id = $studentId;
            $attempt->started_at = now();
        }

        $attempt->answers        = json_encode($answers);
        $attempt->total_marks    = $totalMarks;
        $attempt->obtained_marks = $score;
        $attempt->percentage     = $percentage;
        $attempt->grade          = $grade;          // NEW
        $attempt->result_status  = $resultStatus;   // NEW: Pass/Fail
        $attempt->status         = 'completed';
        $attempt->submitted_at   = now();
        $attempt->save();

        return redirect('/exam/result/'.$attempt->id)
            ->with('success', 'Exam submitted successfully.');

    }
    

    public function examResult($attemptId)
    {
        $attempt = ExamAttempt::with('exam')->findOrFail($attemptId);
        $exam    = $attempt->exam;

        // Exam ke JSON fields ko array me convert karo
        $questions = $exam->questions_array; // accessor
        $options   = is_array($exam->options)
            ? $exam->options
            : (json_decode($exam->options, true) ?? []);

        $correct   = is_array($exam->correct_answer)
            ? $exam->correct_answer
            : (json_decode($exam->correct_answer, true) ?? []);

        // Agar answers JSON me exam_attempts table me store kar rahe ho:
        // $studentAnswers = is_array($attempt->answers ?? null)
        //     ? $attempt->answers
        //     : (json_decode($attempt->answers ?? '[]', true) ?? []);

        $studentAnswers = json_decode($attempt->answers ?? '[]', true);

        return view('Student.exam_result', [
            'exam'           => $exam,
            'attempt'        => $attempt,
            'questions'      => $questions,
            'options'        => $options,
            'correctAnswers' => $correct,
            'studentAnswers' => $studentAnswers,
        ]);
    }

    public function viewExamAttempts()
    {
        if (!session()->has('student_id')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $studentId = session('student_id');

        $attempts = ExamAttempt::with('exam')
            ->where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student/exam_attempts', compact('attempts'));
    }
}
