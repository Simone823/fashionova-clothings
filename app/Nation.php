<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sigle_numeric',
        'sigle_iso_3',
        'sigle_iso_2'
    ];
}