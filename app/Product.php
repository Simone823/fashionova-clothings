<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;
use Intervention\Image\Facades\Image;

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
        'price_discounted',
        'description',
        'visible'
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
        'price_discounted',
        'total_quantity',
        'visible',
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
     * Salva sullo storage le immagini e salva sul db l'array dei path delle immagini
     *
     * @param ?array $imagesColors
     *
     * @return void
     */
    public function uploadImagesColors(?array $imagesColors): void
    {
        if ($imagesColors && count($imagesColors) > 0) {
            // array path images
            $arrayPathImages = json_decode($this->images) ?? [];

            foreach ($imagesColors as $colorId => $imagesColor) {
                // contatore per il numero del file del colore attuale
                $colorName = Color::where('id', $colorId)->pluck('name')->first();
                $fileNumber = $this->getTotalImagesByColorName($colorName) + 1;

                foreach ($imagesColor as $image) {
                    // calcolo il nome del file
                    $productName = str_replace(' ', '-', $this->name);
                    $nameFile = "{$productName}_{$colorName}-{$fileNumber}.{$image->extension()}";

                    // ridimensiono l'immagine
                    $imageResized = Image::make($image->getRealPath())->fit(600, 800, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();

                    // Salva l'immagine in storage public con il nome del file corretto
                    $imageResized->save(Storage::path('public/uploads/images/products/' . $nameFile));

                    // Ottieni il percorso completo del file ridimensionato
                    $imagePath = "uploads/images/products/{$imageResized->basename}";

                    // Pusha il percorso dell'immagine nell'arrayPathImages
                    array_push($arrayPathImages, $imagePath);

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
            // Elimino tutte le immagini del prodotto
            foreach (json_decode($this->images) as $image) {
                Storage::delete("public/{$image}");
            }

            // se esiste ancora il prodotto, aggiorno il campo images
            if ($this) {
                $this->images = null;
                $this->update();
            }
        }
    }

    /**
     * Elimina un'immagine specifica e aggiorna il campo images
     *
     * @param string $pathImage
     *
     * @return void
     */
    public function deleteImage(string $pathImage): void
    {
        // elimino l'immagine
        Storage::delete("public/{$pathImage}");

        // cerco il path nel campo images del prodotto
        $productImages = json_decode($this->images);
        $pathFound = array_search($pathImage, $productImages);

        if ($pathFound !== false) {
            // unset della key immagine trovata
            unset($productImages[$pathFound]);

            // aggiorno il campo images, ricostruendo l'array di path ripartendo da indice 0
            $this->images = json_encode(array_values($productImages));
            $this->update();
        }
    }

    /**
     * Ottieni il prezzo scontato
     *
     * @return string
     */
    public function getPriceDiscounted(): ?string
    {
        if (!empty($this->discount_percent)) {
            // calcolo prezzo scontato
            $priceDiscounted = $this->price - ($this->price * ($this->discount_percent / 100));

            return number_format($priceDiscounted, 2);
        }

        return null;
    }
    
    /**
     * Method scope Filtra prodotti
     *
     * @param Builder $query
     * @param Request $request
     *
     * @return void
     */
    public function scopeFilterProducts(Builder $query, Request $request): void
    {
        // recupero il metodo del controller per salvare i filtri in base al metodo
        $methodController = str_replace('/products/', '', $request->server('PATH_INFO'));

        // Recupera i filtri salvati in sessione
        $filters = session()->get("filters.{$methodController}", []);

        if ($request->all()) {
            // validazione request
            $request->validate([
                'action_submit' => 'integer',
                'action_reset' => 'integer',
                'genres' => 'array',
                'genres.*' => 'integer|exists:genres,id',
                'categories' => 'array',
                'categories.*' => 'integer|exists:categories,id',
                'sizes' => 'array',
                'sizes.*' => 'integer|exists:sizes,id',
                'colors' => 'array',
                'colors.*' => 'integer|exists:colors,id',
                'order_by' => 'nullable|string|in:price-asc,price-desc,discount_percent-desc'
            ]);

            // azione submit
            if ($request->action_submit == 1) {
                // salvo i filtri in sessione
                $filters = $request->all();
                session()->put("filters.{$methodController}", $filters);
            }

            // azione reset
            if ($request->action_reset == 1) {
                // svuoto i filtri in sessione
                $filters = [];
                session()->put("filters.{$methodController}", $filters);
            }
        }

        // Applica filtri se presenti
        if (!empty($filters)) {
            if (isset($filters['genres'])) {
                $query->whereIn('genre_id', $filters['genres']);
            }

            if (isset($filters['categories'])) {
                $query->whereHas('categories', function ($categoryQuery) use ($filters) {
                    $categoryQuery->whereIn('id', $filters['categories']);
                });
            }

            if (isset($filters['sizes'])) {
                $query->whereHas('sizes', function ($sizeQuery) use ($filters) {
                    $sizeQuery->whereIn('id', $filters['sizes']);
                });
            }

            if (isset($filters['colors'])) {
                $query->whereHas('colors', function ($colorQuery) use ($filters) {
                    $colorQuery->whereIn('id', $filters['colors']);
                });
            }

            if (isset($filters['order_by']) && !empty($filters['order_by'])) {
                // recupero la colonna e l'ordinamento
                $values = explode('-', $filters['order_by']);
                $column = $values[0];
                $order = $values[1];

                if ($column == 'price') {
                    // Ordina per prezzo e ricalcola il prezzo se un prodotto è scontato
                    $query->orderByRaw("IF(discount_percent IS NULL OR discount_percent = '', price, (price - (price * discount_percent / 100))) $order");
                } else {
                    // ordina per la colonna specificata
                    $query->orderBy($column, $order);
                }
            }
        }
    }

    /**
     * Ottieni il numero totale di immagini per colore
     *
     * @param string $colorName
     *
     * @return int
     */
    private function getTotalImagesByColorName(string $colorName): int
    {
        // Array per tenere traccia del massimo numero di file per colore
        $maxFileNumbers = [];

        if (!empty($this->images)) {
            // Trova il massimo numero di file per ogni colore
            foreach (json_decode($this->images) as $imagePath) {
                preg_match('/_(\w+)-(\d+)\./', $imagePath, $matches);
                $nameColor = $matches[1];
                $numberFile = intval($matches[2]);
                $maxFileNumbers[$nameColor] = isset($maxFileNumbers[$nameColor]) ? max($maxFileNumbers[$nameColor], $numberFile) : $numberFile;
            }
        }

        return $maxFileNumbers[$colorName] ?? 0;
    }
}