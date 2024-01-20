<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRoleModel;

class Role extends SpatieRoleModel
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