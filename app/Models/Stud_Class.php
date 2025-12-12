<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stud_Class extends Model
{
    protected $table = 'stud_class';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['name', 'section', 'academic_year'];

    public function getFullNameAttribute()
    {
        return $this->name . ' - ' . $this->section;
    }
}
