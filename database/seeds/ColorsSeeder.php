<?php

use App\Color;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array colori
        $colors = array(
            'Black',
            'White',
            'Red',
            'Blue',
            'Green',
            'Yellow',
            'Purple'
        );

        // creo i colori
        foreach ($colors as $color) {
            $newColor = new Color();
            $newColor->name = ucfirst($color);
            $newColor->save();
        }
    }
}