<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'genre',
        'price',
        'quantity_available',
        'description'
    ];

    /**
     * Sortable
     *
     * @var array
     */
    public $sortable = [
        'code',
        'name',
        'genre',
        'price',
        'quantity_available',
        'created_at',
        'updated_at'
    ];

    /**
     * Relazione molti a molti con tabella -> 'categories'
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
        
    /**
     * Relazione molti a molti con tabella -> 'sizes'
     *
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class)->withPivot('quantity_available');
    }
    
    /**
     * Ottieni il prezzo scontato
     *
     * @return float
     */
    public function getPriceDiscounted(): float
    {
        // calcolo prezzo scontato
        $priceDiscounted = $this->price - ($this->price * ($this->discount_percent / 100));

        return round($priceDiscounted, 2); 
    }
}