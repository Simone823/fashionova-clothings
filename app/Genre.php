<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

class Genre extends Model
{
    use Sortable;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * sortable
     *
     * @var array
     */
    public $sortable = [
        'name',
        'created_at',
        'updated_at'
    ];

    
    /**
     * Relazione uno a molti con tabella -> 'products'
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}