<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset_details extends Model
{
    protected $fillable = ['fa_sub_category','code','campus_id' ,
    'room',
    'custodian' ,
    'description',
    'make/model',
    'name',
    'fa_sub_category_code',
    'fa_category_code',
    'fa_category',
    'status',
    'quantity',
    'condition',
    'asset_image_id' ];
    
}
