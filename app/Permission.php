<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Models\Permission as SpatiePermissionModel;

class Permission extends SpatiePermissionModel 
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