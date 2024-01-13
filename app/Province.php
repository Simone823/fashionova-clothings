<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sigle',
        'nation_id',
        'region_id'
    ];

    public function nation()
    {
        return $this->belongsTo(Nation::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}