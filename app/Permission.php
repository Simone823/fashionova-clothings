<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermissionModel;

class Permission extends SpatiePermissionModel 
{   
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name'
    ];
}