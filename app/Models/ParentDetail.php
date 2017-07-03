<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentDetail extends Model
{
    protected $table = 'parent_detail';
    public function parent_info()
    {
    	return $this->hasOne('App\Models\ParentInfo','id','tid');
    }
}
