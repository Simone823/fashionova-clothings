<?php

use App\Category;
use App\Color;
use App\Genre;
use App\Product;
use App\Size;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array prodotti
        $products = array(
            [
                'name' => 'Felpa logo love senza cappuccio',
                'genre_id' => Genre::where('name', 'Donna')->pluck('id')->first(),
                'price' => 50.00,
                'discount_percent' => 5.00,
                'visible' => 1,
                'description' => null,
                'categories' => Category::where('name', 'Abbigliamento')
                    ->orWhere('name', 'Maglioni E Felpe')
                    ->pluck('id')->toArray(),
                'sizes' => array(
                    array(
                        'size_id' => Size::where('name', 'XS')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'XL')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'S')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'M')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'L')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    )
                ),
                'images' => array(
                    "uploads/images/products/Felpa-logo-love-senza-cappuccio_Black-1.png",
                    "uploads/images/products/Felpa-logo-love-senza-cappuccio_Green-1.png",
                    "uploads/images/products/Felpa-logo-love-senza-cappuccio_Purple-1.png",
                    "uploads/images/products/Felpa-logo-love-senza-cappuccio_White-1.png"
                )
            ],
            [
                'name' => 'Felpa gatto senza cappuccio',
                'genre_id' => Genre::where('name', 'Donna')->pluck('id')->first(),
                'price' => 75.00,
                'discount_percent' => 15.00,
                'visible' => 1,
                'description' => null,
                'categories' => Category::where('name', 'Abbigliamento')
                    ->orWhere('name', 'Maglioni E Felpe')
                    ->pluck('id')->toArray(),
                'sizes' => array(
                    array(
                        'size_id' => Size::where('name', 'XS')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'XL')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'S')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'M')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'L')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    )
                ),
                'images' => array(
                    "uploads/images/products/Felpa-gatto-senza-cappuccio_Black-1.png",
                    "uploads/images/products/Felpa-gatto-senza-cappuccio_Purple-1.png",
                    "uploads/images/products/Felpa-gatto-senza-cappuccio_Red-1.png",
                    "uploads/images/products/Felpa-gatto-senza-cappuccio_White-1.png"
                )
            ],
            [
                'name' => 'Felpa scritta save senza cappuccio',
                'genre_id' => Genre::where('name', 'Donna')->pluck('id')->first(),
                'price' => 32.00,
                'discount_percent' => 10.00,
                'visible' => 1,
                'description' => null,
                'categories' => Category::where('name', 'Abbigliamento')
                    ->orWhere('name', 'Maglioni E Felpe')
                    ->pluck('id')->toArray(),
                'sizes' => array(
                    array(
                        'size_id' => Size::where('name', 'XS')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'XL')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'S')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'M')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'L')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Green')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    )
                ),
                'images' => array(
                    "uploads/images/products/Felpa-scritta-save-senza-cappuccio_Black-1.png",
                    "uploads/images/products/Felpa-scritta-save-senza-cappuccio_Green-1.png",
                    "uploads/images/products/Felpa-scritta-save-senza-cappuccio_Purple-1.png",
                    "uploads/images/products/Felpa-scritta-save-senza-cappuccio_Red-1.png"
                )
            ],
            [
                'name' => 'Felpa scritta gold like my soul senza cappuccio',
                'genre_id' => Genre::where('name', 'Donna')->pluck('id')->first(),
                'price' => 66.00,
                'discount_percent' => 45.00,
                'visible' => 1,
                'description' => null,
                'categories' => Category::where('name', 'Abbigliamento')
                    ->orWhere('name', 'Maglioni E Felpe')
                    ->pluck('id')->toArray(),
                'sizes' => array(
                    array(
                        'size_id' => Size::where('name', 'XS')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'XL')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'S')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'M')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'L')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    )
                ),
                'images' => array(
                    "uploads/images/products/Felpa-scritta-gold-like-my-soul-senza-cappuccio_Purple-1.png",
                    "uploads/images/products/Felpa-scritta-gold-like-my-soul-senza-cappuccio_White-1.png"
                )
            ],
            [
                'name' => 'Felpa fiore senza cappuccio',
                'genre_id' => Genre::where('name', 'Donna')->pluck('id')->first(),
                'price' => 55.00,
                'discount_percent' => 20.00,
                'visible' => 1,
                'description' => null,
                'categories' => Category::where('name', 'Abbigliamento')
                    ->orWhere('name', 'Maglioni E Felpe')
                    ->pluck('id')->toArray(),
                'sizes' => array(
                    array(
                        'size_id' => Size::where('name', 'XS')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'XL')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'S')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'M')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'L')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Red')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    )
                ),
                'images' => array(
                    "uploads/images/products/Felpa-fiore-senza-cappuccio_Black-1.png",
                    "uploads/images/products/Felpa-fiore-senza-cappuccio_Purple-1.png",
                    "uploads/images/products/Felpa-fiore-senza-cappuccio_Red-1.png",
                    "uploads/images/products/Felpa-fiore-senza-cappuccio_White-1.png"
                )
            ],
            [
                'name' => 'Felpa logo woman senza cappuccio',
                'genre_id' => Genre::where('name', 'Donna')->pluck('id')->first(),
                'price' => 72.00,
                'discount_percent' => 5.00,
                'visible' => 1,
                'description' => null,
                'categories' => Category::where('name', 'Abbigliamento')
                    ->orWhere('name', 'Maglioni E Felpe')
                    ->pluck('id')->toArray(),
                'sizes' => array(
                    array(
                        'size_id' => Size::where('name', 'XS')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'XL')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'S')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'M')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    ),
                    array(
                        'size_id' => Size::where('name', 'L')->pluck('id')->first(),
                        'colors' => array(
                            array(
                                'color_id' => Color::where('name', 'Black')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'Purple')->pluck('id')->first(),
                                'quantity_available' => 20
                            ),
                            array(
                                'color_id' => Color::where('name', 'White')->pluck('id')->first(),
                                'quantity_available' => 20
                            )
                        )
                    )
                ),
                'images' => array(
                    "uploads/images/products/Felpa-logo-woman-senza-cappuccio_Black-1.png",
                    "uploads/images/products/Felpa-logo-woman-senza-cappuccio_Purple-1.png",
                    "uploads/images/products/Felpa-logo-woman-senza-cappuccio_White-1.png"
                )
            ],
        );

        // creo i prodotti
        foreach ($products as $product) {
            $newProduct = new Product();
            $newProduct->name = ucfirst($product['name']);
            $newProduct->genre_id = $product['genre_id'];
            $newProduct->price = $product['price'];
            $newProduct->discount_percent = $product['discount_percent'];
            $newProduct->visible = $product['visible'];
            $newProduct->description = $product['description'];
            $newProduct->images = json_encode($product['images']);
            $newProduct->save();

            // cacola e setta codice prodotto
            $newProduct->calculateAndSetCodeProduct();

            // allego le categorie
            foreach ($product['categories'] as $categoryId) {
                $newProduct->categories()->attach($categoryId);
            }

            // allego le taglie, colori e relative quantità
            foreach ($product['sizes'] as $sizeData) {
                $newProduct->sizes()->attach($sizeData['size_id']);

                // allego i colori e le quantità
                foreach($sizeData['colors'] as $colorData) {
                    $newProduct->colors()->attach($colorData['color_id'], [
                        'size_id' => $sizeData['size_id'],
                        'quantity_available' => $colorData['quantity_available']
                    ]);
                }
            }

            // calcola e setta quantità totale
            $newProduct->calculateAndSetTotalQuantity();
        }
    }
}