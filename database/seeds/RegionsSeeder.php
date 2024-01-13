<?php

use App\Nation;
use App\Region;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // nazione italia
        $idItalyNation = Nation::where('name', 'Italia')->pluck('id')->first();

        // array regioni
        $regions = array(
            [
                'name' => 'Piemonte',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => "Valle D'Aosta",
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Lombardia',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Trentino Alto Adige',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Veneto',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Friuli Venezia Giulia',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Liguria',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Emilia Romagna',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Toscana',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Umbria',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Marche',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Lazio',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Abruzzo',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Molise',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Campania',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Puglia',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Basilicata',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Calabria',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Sicilia',
                'nation_id' => $idItalyNation
            ],
            [
                'name' => 'Sardegna',
                'nation_id' => $idItalyNation
            ],
        );

        foreach ($regions as $region) {
            // crea nuova regione
            $newRegion = new Region();
            $newRegion->name = $region['name'];
            $newRegion->nation_id = $region['nation_id'];
            $newRegion->save();
        }
    }
}
