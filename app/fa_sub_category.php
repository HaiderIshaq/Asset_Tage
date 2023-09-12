<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fa_sub_category extends Model
{
    protected $fillable = ['id','name','code','fa_category_code'];
}
