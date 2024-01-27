<?php

use App\Size;
use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array taglie
        $sizes = array(
            'XS',
            'S',
            'M',
            'L',
            'XL',
            'XXL',
            'XXXL',
        );

        // creo le taglie
        foreach ($sizes as $size) {
            $newSize = new Size();
            $newSize->name = strtoupper($size);
            $newSize->save();
        }
    }
}