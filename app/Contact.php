<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
    use Sortable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'subject',
        'message'
    ];

    /**
     * Sortable
     *
     * @var array
     */
    public $sortable = [
        'name',
        'surname',
        'email',
        'phone',
        'subject',
        'created_at',
        'updated_at'
    ];
}