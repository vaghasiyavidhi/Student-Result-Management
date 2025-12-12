<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'subject_name',
        'class_section',
        'exam_title',
        'description',
        'duration_minutes',
        'questions',
        'options',
        'correct_answer',
        'marks',
        'status',
        'class_section',
    ];

    protected $casts = [
        'questions' => 'array',
        'options' => 'array',
        'correct_answer' => 'array',
        'marks' => 'array',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_name', 'name');
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class, 'exam_id', 'id');
    }

    /**
     * Get questions as array, handling both JSON string and array formats
     */
    public function getQuestionsArrayAttribute()
    {
        if (is_array($this->questions)) {
            return $this->questions;
        }
        if (is_string($this->questions)) {
            $decoded = json_decode($this->questions, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }

    /**
     * Get question count
     */
    public function getQuestionCountAttribute()
    {
        return count($this->questions_array);
    }
}

