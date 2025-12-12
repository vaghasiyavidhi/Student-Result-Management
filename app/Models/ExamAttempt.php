<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    protected $table = 'exam_attempts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['student_id', 'exam_id', 'started_at', 'submitted_at', 'answers', 'total_marks', 'obtained_marks', 'percentage', 'status'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
