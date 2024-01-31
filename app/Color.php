<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kyslik\ColumnSortable\Sortable;

class Color extends Model
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
     * Relazione molti a molti con tabella -> 'products'
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_size_color')->withPivot('quantity_available');
    }
}