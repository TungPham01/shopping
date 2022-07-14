<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    protected $guarded;

    public function permissionsChildren() {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}
