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
        'name',
        'genre',
        'price',
        'discount_percent',
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
        'discount_percent',
        'total_quantity',
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
     * Calcola e setta il codice prodotto
     *
     * @return void
     */
    public function calculateAndSetCodeProduct(): void
    {
        // codice prodotto
        $productCode = "PR{$this->id}";

        // aggiungo lo zero se id è minore di 10
        if ($this->id < 10) {
            $productCode = "PR0{$this->id}";
        }

        // setto il codice prodotto
        $this->code = $productCode;
        $this->update();
    }
    
    /**
     * Calcola e setta il totale quantità di tutte le taglie
     *
     * @return void
     */
    public function calculateAndSetTotalQuantity(): void
    {
        // totale quantità
        $totalQuantity = 0;

        // calcolo le quantità totali per tutte le taglie
        if (count($this->sizes) > 0) {
            foreach ($this->sizes as $size) {
                $totalQuantity += $size->pivot->quantity_available;
            }
        }

        // setto il totale quantità
        $this->total_quantity = $totalQuantity;
        $this->update();
    }

    /**
     * Ottieni il prezzo scontato
     *
     * @return string
     */
    public function getPriceDiscounted(): string
    {
        // calcolo prezzo scontato
        $priceDiscounted = $this->price - ($this->price * ($this->discount_percent / 100));

        return number_format($priceDiscounted, 2);
    }
}