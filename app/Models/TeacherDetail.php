<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    protected $table = 'teacher_detail';
    public function teacherinfo()
    {
    	return $this->hasOne('App\Models\TeacherInfo','id','tid');
    }
}
