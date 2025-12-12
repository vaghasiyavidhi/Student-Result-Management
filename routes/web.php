<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;

Route::get('/',[StudentController::class,'Home']);
Route::get('/login',[StudentController::class,'Login']);
Route::post('/login',[StudentController::class,'Login_student']);
Route::get('result',[StudentController::class,'Result']);

Route::get('/dashboard',[StudentController::class,'Dashboard']);
Route::get('/profile',[StudentController::class,'Profile']);
Route::get('/exams',[StudentController::class,'Exams']);
Route::get('/exam/take/{id}',[StudentController::class,'takeExam']);
Route::post('/exam/submit/{id}',[StudentController::class,'submitExam']);
Route::get('/exam/result/{attemptId}',[StudentController::class,'examResult']);
Route::get('/exam/attempts', [StudentController::class, 'viewExamAttempts']);

Route::get('/admin',[AdminController::class,'Login']);
Route::post('/admin',[AdminController::class,'Login_admin']);
Route::get('/admin/dashboard',[AdminController::class,'Dashboard']);
Route::post('/logout', [AdminController::class,'Logout']);

Route::get('/admin/add_class',[AdminController::class,'addClass']);
Route::post('/admin/insert_class',[AdminController::class,'insertClass']);
Route::get('/admin/manage_class',[AdminController::class,'manageClass']);
Route::get('/admin/edit_class/{id}',[AdminController::class,'editClass']);
Route::post('/admin/edit_class/{id}',[AdminController::class,'updateClass']);
Route::get('/admin/delete_class/{id}',[AdminController::class,'deleteClass']);

Route::get('/admin/add_sub',[AdminController::class,'addSubject']);
Route::post('/admin/insert_sub',[AdminController::class,'insertSubject']);
Route::get('/admin/manage_sub',[AdminController::class,'manageSubject']);
Route::get('/admin/edit_sub/{id}',[AdminController::class,'editSubject']);
Route::post('/admin/edit_sub/{id}',[AdminController::class,'updateSubject']);
Route::get('/admin/delete_sub/{id}',[AdminController::class,'deleteSubject']);

Route::get('/admin/add_stud',[AdminController::class,'addStudent']);
Route::post('/admin/insert_stud',[AdminController::class,'insertStudent']);
Route::get('/admin/manage_stud',[AdminController::class,'manageStudent']);
Route::get('/admin/edit_stud/{id}',[AdminController::class,'editStudent']);
Route::post('/admin/edit_stud/{id}',[AdminController::class,'updateStudent']);
Route::get('/admin/delete_stud/{id}',[AdminController::class,'deleteStudent']);

Route::get('/admin/add_exam',[AdminController::class,'addExam']);
Route::post('/admin/insert_exam',[AdminController::class,'insertExam']);
Route::post('/admin/fetch-students', [AdminController::class, 'fetchStudents']);
Route::post('/admin/fetch-subjects', [AdminController::class, 'fetchSubjects']);
Route::get('/admin/manage_exam',[AdminController::class,'manageExam']);
Route::get('/admin/edit_exam/{id}',[AdminController::class,'editExam']);
Route::post('/admin/edit_exam/{id}',[AdminController::class,'updateExam']);
Route::get('/admin/delete_exam/{id}',[AdminController::class,'deleteExam']);

Route::get('/admin/add_res',[AdminController::class,'addResult']);
Route::post('/admin/insert_res',[AdminController::class,'insertResult']);
Route::get('/admin/manage_res',[AdminController::class,'manageResult']);
Route::get('/admin/edit_res/{id}',[AdminController::class,'editResult']);
Route::post('/admin/edit_res/{id}',[AdminController::class,'updateResult']);
Route::get('/admin/delete_res/{id}',[AdminController::class,'deleteResult']);

// Add these AJAX routes
Route::get('/admin/get-students-by-class/{classId}',[AdminController::class,'getStudentsByClass']);
Route::get('/admin/get-subjects-by-class/{classId}',[AdminController::class,'getSubjectsByClass']);
Route::get('/admin/get-next-roll-number/{classId}',[AdminController::class,'getNextRollNumber']);

Route::get('/admin/add_notice',[AdminController::class,'addNotice']);
Route::post('/admin/insert_notice',[AdminController::class,'insertNotice']);
Route::get('/admin/manage_notice',[AdminController::class,'manageNotice']);
Route::get('/admin/edit_notice/{id}',[AdminController::class,'editNotice']);
Route::post('/admin/edit_notice/{id}',[AdminController::class,'updateNotice']);
Route::get('/admin/delete_notice/{id}',[AdminController::class,'deleteNotice']);

Route::get('/admin/admin_pass',[AdminController::class,'adminPass']);
Route::post('/admin/admin_pass',[AdminController::class,'updatePassword']);