<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campus extends Model
{
    protected $fillable = ['id','name','district_id','city','address'];
}
