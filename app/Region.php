<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nation_id'
    ];
    
    public function nation()
    {
        return $this->belongsTo(Nation::class);
    }

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}