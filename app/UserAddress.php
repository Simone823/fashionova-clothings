<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class UserAddress extends Model
{
    use Sortable;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'is_primary',
        'user_id',
        'nation_id',
        'region_id',
        'province_id',
        'city_id',
        'cap',
        'address',
        'house_number'
    ];

    /**
     * sortable
     *
     * @var array
     */
    public $sortable = [
        'is_primary',
        'user_id',
        'nation_id',
        'region_id',
        'province_id',
        'city_id',
        'cap',
        'address',
        'house_number',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nation()
    {
        return $this->belongsTo(Nation::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}