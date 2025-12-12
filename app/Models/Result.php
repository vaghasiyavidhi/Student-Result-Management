<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'result';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['roll_no', 'stud_name', 'class_name', 'subject_name', 'mark_obtained', 'status'];
}
