<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name','parent_id','slug'];

    // tự lên quan hệ của chính nó, 1 category có nhiều con
    public function categoryChildren() {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
