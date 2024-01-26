<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{    
    use Sortable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Sortable
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
        return $this->belongsToMany(Product::class);
    }
}