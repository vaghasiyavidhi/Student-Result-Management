<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['sub_code', 'name', 'assign_class'];

    public function exams() {
        return $this->hasMany(Exam::class, 'subject_name', 'name');
    }

    public function classInfo() {
        return $this->belongsTo(Stud_Class::class, 'assign_class');
    }
}
