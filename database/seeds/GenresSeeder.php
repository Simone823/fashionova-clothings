<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array generi
        $genres = array(
            'Uomo',
            'Donna'
        );

        // creo i generi
        foreach ($genres as $genre) {
            $newGenre = new Genre();
            $newGenre->name = ucfirst($genre);
            $newGenre->save();
        }
    }
}