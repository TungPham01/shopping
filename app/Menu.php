<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    //
    use SoftDeletes;
//    $fillable: khai báo những cột được viết trong câu query và insert
    protected $fillable = ['name','parent_id','slug'];
}
