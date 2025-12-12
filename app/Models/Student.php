<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['roll_no', 'name', 'class', 'email', 'phone', 'DOB', 'gender'];

    public function exams() {
        return $this->hasMany(Exam::class, 'class_section', 'class');
    }

    public function classInfo() {
        return $this->belongsTo(Stud_Class::class, 'class');
    }
}
