<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array categorie
        $categories = array(
            'Abbigliamento',
            'Scarpe',
            'Abbigliamento Sportivo',
            'Gonne e Pantaloni',
            'T-shirt',
            'Pantaloni',
            'Maglioni e Felpe',
            'Giacche e Cappotti',
            'Borse',
            'Accessori'
        );

        // creo le categorie
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = ucwords($category);
            $newCategory->save();
        }
    }
}