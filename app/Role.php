<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Models\Role as SpatieRoleModel;

class Role extends SpatieRoleModel
{   
    use Sortable;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * sortable
     *
     * @var array
     */
    public $sortable = [
        'name',
        'guard_name',
        'created_at',
        'updated_at'
    ];
}