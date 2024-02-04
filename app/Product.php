<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
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
        'genre_id',
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
        'price',
        'discount_percent',
        'total_quantity',
        'created_at',
        'updated_at'
    ];

    /**
     * Relazione molti a uno con tabella -> 'genres' 
     *
     * @return BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

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
        return $this->belongsToMany(Size::class);
    }

    /**
     * Relazione molti a molti con tabella -> 'colors'
     *
     * @return BelongsToMany
     */
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_size_color')->withPivot('quantity_available');
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

        // calcolo le quantità totali per tutti colori
        if (count($this->colors) > 0) {
            foreach ($this->colors as $color) {
                $totalQuantity += $color->pivot->quantity_available;
            }
        }

        // setto il totale quantità
        $this->total_quantity = $totalQuantity;
        $this->update();
    }

    /**
     * Salva sullo storage 'uploads/products' le immagini, e salva sul db l'array dei path delle immagini
     *
     * @param ?array $imagesColors [explicite description]
     *
     * @return void
     */
    public function uploadImagesColors(?array $imagesColors): void
    {
        if ($imagesColors && count($imagesColors) > 0) {
            // array path images
            $arrayPathImages = json_decode($this->images) ?? [];

            // Array per tenere traccia del massimo numero di file per colore
            $maxFileNumbers = [];

            // Trova il massimo numero di file per ogni colore
            foreach ($arrayPathImages as $imagePath) {
                preg_match('/_(\w+)-(\d+)\./', $imagePath, $matches);
                $colorName = $matches[1];
                $numberFile = intval($matches[2]);
                $maxFileNumbers[$colorName] = isset($maxFileNumbers[$colorName]) ? max($maxFileNumbers[$colorName], $numberFile) : $numberFile;
            }
            
            foreach ($imagesColors as $colorId => $imagesColor) {
                // contatore per il numero del file del colore attuale
                $colorName = Color::where('id', $colorId)->pluck('name')->first();
                $fileNumber = isset($maxFileNumbers[$colorName]) ? $maxFileNumbers[$colorName] + 1 : 1;

                foreach ($imagesColor as $image) {
                    // calcolo il nome del file
                    $productName = str_replace(' ', '-', $this->name);
                    $nameFile = "{$productName}_{$colorName}-{$fileNumber}.{$image->extension()}";

                    // path immagine salvato in storage public
                    $imgPath = Storage::putFileAs('public/uploads/images/products', $image, $nameFile);

                    // pusho il path img sul arrayPathImages
                    $imgPath = str_replace('public/', '', $imgPath);
                    array_push($arrayPathImages, $imgPath);

                    // incrementa numero file per il prossimo file
                    $fileNumber++;
                }
            }

            // aggiorno il campo images
            $this->images = json_encode($arrayPathImages);
            $this->update();
        }
    }

    /**
     * Elimina tutte le immagini dallo storage e imposto a null il campo 'images'
     *
     * @return void
     */
    public function deleteAllImages(): void
    {
        if (!empty($this->images)) {
            foreach (json_decode($this->images) as $image) {
                Storage::delete("public/{$image}");
            }

            // controllo se esiste ancora il prodotto e aggiorno il campo images
            if ($this) {
                $this->images = null;
                $this->update();
            }
        }
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