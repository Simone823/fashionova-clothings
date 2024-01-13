<?php

use App\Nation;
use App\Region;
use App\Province;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
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

        // array province
        $provinces = array(
            [
                'sigle' => 'TO',
                'name' => 'Torino',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'VC',
                'name' => 'Vercelli',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'NO',
                'name' => 'Novara',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'CN',
                'name' => 'Cuneo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'AT',
                'name' => 'Asti',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'AL',
                'name' => 'Alessandria',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'AO',
                'name' => 'Aosta',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', "Valle D'Aosta")->pluck('id')->first()
            ],
            [
                'sigle' => 'IM',
                'name' => 'Imperia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Liguria')->pluck('id')->first()
            ],
            [
                'sigle' => 'SV',
                'name' => 'Savona',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Liguria')->pluck('id')->first()
            ],
            [
                'sigle' => 'GE',
                'name' => 'Genova',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Liguria')->pluck('id')->first()
            ],
            [
                'sigle' => 'SP',
                'name' => 'La Spezia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Liguria')->pluck('id')->first()
            ],
            [
                'sigle' => 'VA',
                'name' => 'Varese',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'CO',
                'name' => 'Como',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'SO',
                'name' => 'Sondrio',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'MI',
                'name' => 'Milano',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'BG',
                'name' => 'Bergamo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'BS',
                'name' => 'Brescia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'PV',
                'name' => 'Pavia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'CR',
                'name' => 'Cremona',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'MN',
                'name' => 'Mantova',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'BZ',
                'name' => 'Bolzano',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Trentino Alto Adige')->pluck('id')->first()
            ],
            [
                'sigle' => 'TN',
                'name' => 'Trento',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Trentino Alto Adige')->pluck('id')->first()
            ],
            [
                'sigle' => 'VR',
                'name' => 'Verona',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Veneto')->pluck('id')->first()
            ],
            [
                'sigle' => 'VI',
                'name' => 'Vicenza',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Veneto')->pluck('id')->first()
            ],
            [
                'sigle' => 'BL',
                'name' => 'Belluno',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Veneto')->pluck('id')->first()
            ],
            [
                'sigle' => 'TV',
                'name' => 'Treviso',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Veneto')->pluck('id')->first()
            ],
            [
                'sigle' => 'VE',
                'name' => 'Venezia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Veneto')->pluck('id')->first()
            ],
            [
                'sigle' => 'PD',
                'name' => 'Padova',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Veneto')->pluck('id')->first()
            ],
            [
                'sigle' => 'RO',
                'name' => 'Rovigo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Veneto')->pluck('id')->first()
            ],
            [
                'sigle' => 'UD',
                'name' => 'Udine',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Friuli Venezia Giulia')->pluck('id')->first()
            ],
            [
                'sigle' => 'GO',
                'name' => 'Gorizia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Friuli Venezia Giulia')->pluck('id')->first()
            ],
            [
                'sigle' => 'TS',
                'name' => 'Trieste',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Friuli Venezia Giulia')->pluck('id')->first()
            ],
            [
                'sigle' => 'PC',
                'name' => 'Piacenza',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'PR',
                'name' => 'Parma',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'RE',
                'name' => "Reggio Nell'Emilia",
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'MO',
                'name' => 'Modena',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'BO',
                'name' => 'Bologna',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'FE',
                'name' => 'Ferrara',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'RA',
                'name' => 'Ravenna',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'FC',
                'name' => "Forlì Cesena",
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'PU',
                'name' => 'Pesaro E Urbino',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Marche')->pluck('id')->first()
            ],
            [
                'sigle' => 'AN',
                'name' => 'Ancona',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Marche')->pluck('id')->first()
            ],
            [
                'sigle' => 'MC',
                'name' => 'Macerata',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Marche')->pluck('id')->first()
            ],
            [
                'sigle' => 'AP',
                'name' => 'Ascoli Piceno',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Marche')->pluck('id')->first()
            ],
            [
                'sigle' => 'MS',
                'name' => 'Massa-Carrara',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'LU',
                'name' => 'Lucca',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'PT',
                'name' => 'Pistoia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'FI',
                'name' => 'Firenze',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'LI',
                'name' => 'Livorno',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'PI',
                'name' => 'Pisa',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'AR',
                'name' => 'Arezzo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'SI',
                'name' => 'Siena',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'GR',
                'name' => 'Grosseto',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'PG',
                'name' => 'Perugia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Umbria')->pluck('id')->first()
            ],
            [
                'sigle' => 'TR',
                'name' => 'Terni',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Umbria')->pluck('id')->first()
            ],
            [
                'sigle' => 'VT',
                'name' => 'Viterbo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lazio')->pluck('id')->first()
            ],
            [
                'sigle' => 'RI',
                'name' => 'Rieti',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lazio')->pluck('id')->first()
            ],
            [
                'sigle' => 'RM',
                'name' => 'Roma',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lazio')->pluck('id')->first()
            ],
            [
                'sigle' => 'LT',
                'name' => 'Latina',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lazio')->pluck('id')->first()
            ],
            [
                'sigle' => 'FR',
                'name' => 'Frosinone',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lazio')->pluck('id')->first()
            ],
            [
                'sigle' => 'CE',
                'name' => 'Caserta',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Campania')->pluck('id')->first()
            ],
            [
                'sigle' => 'BN',
                'name' => 'Benevento',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Campania')->pluck('id')->first()
            ],
            [
                'sigle' => 'NA',
                'name' => 'Napoli',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Campania')->pluck('id')->first()
            ],
            [
                'sigle' => 'AV',
                'name' => 'Avellino',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Campania')->pluck('id')->first()
            ],
            [
                'sigle' => 'SA',
                'name' => 'Salerno',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Campania')->pluck('id')->first()
            ],
            [
                'sigle' => 'AQ',
                'name' => "L'Aquila",
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Abruzzo')->pluck('id')->first()
            ],
            [
                'sigle' => 'TE',
                'name' => 'Teramo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Abruzzo')->pluck('id')->first()
            ],
            [
                'sigle' => 'PE',
                'name' => 'Pescara',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Abruzzo')->pluck('id')->first()
            ],
            [
                'sigle' => 'CH',
                'name' => 'Chieti',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Abruzzo')->pluck('id')->first()
            ],
            [
                'sigle' => 'CB',
                'name' => 'Campobasso',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Molise')->pluck('id')->first()
            ],
            [
                'sigle' => 'FG',
                'name' => 'Foggia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Puglia')->pluck('id')->first()
            ],
            [
                'sigle' => 'BA',
                'name' => 'Bari',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Puglia')->pluck('id')->first()
            ],
            [
                'sigle' => 'TA',
                'name' => 'Taranto',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Puglia')->pluck('id')->first()
            ],
            [
                'sigle' => 'BR',
                'name' => 'Brindisi',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Puglia')->pluck('id')->first()
            ],
            [
                'sigle' => 'LE',
                'name' => 'Lecce',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Puglia')->pluck('id')->first()
            ],
            [
                'sigle' => 'PZ',
                'name' => 'Potenza',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Basilicata')->pluck('id')->first()
            ],
            [
                'sigle' => 'MT',
                'name' => 'Matera',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Basilicata')->pluck('id')->first()
            ],
            [
                'sigle' => 'CS',
                'name' => 'Cosenza',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Calabria')->pluck('id')->first()
            ],
            [
                'sigle' => 'CZ',
                'name' => 'Catanzaro',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Calabria')->pluck('id')->first()
            ],
            [
                'sigle' => 'RC',
                'name' => 'Reggio Di Calabria',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Calabria')->pluck('id')->first()
            ],
            [
                'sigle' => 'TP',
                'name' => 'Trapani',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'PA',
                'name' => 'Palermo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'ME',
                'name' => 'Messina',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'AG',
                'name' => 'Agrigento',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'CL',
                'name' => 'Caltanissetta',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'EN',
                'name' => 'Enna',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'CT',
                'name' => 'Catania',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'RG',
                'name' => 'Ragusa',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'SR',
                'name' => 'Siracusa',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sicilia')->pluck('id')->first()
            ],
            [
                'sigle' => 'SS',
                'name' => 'Sassari',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'NU',
                'name' => 'Nuoro',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'CA',
                'name' => 'Cagliari',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'PN',
                'name' => 'Pordenone',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Friuli Venezia Giulia')->pluck('id')->first()
            ],
            [
                'sigle' => 'IS',
                'name' => 'Isernia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Molise')->pluck('id')->first()
            ],
            [
                'sigle' => 'OR',
                'name' => 'Oristano',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'BI',
                'name' => 'Biella',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'LC',
                'name' => 'Lecco',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'LO',
                'name' => 'Lodi',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'RN',
                'name' => 'Rimini',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Emilia Romagna')->pluck('id')->first()
            ],
            [
                'sigle' => 'PO',
                'name' => 'Prato',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Toscana')->pluck('id')->first()
            ],
            [
                'sigle' => 'KR',
                'name' => 'Crotone',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Calabria')->pluck('id')->first()
            ],
            [
                'sigle' => 'VV',
                'name' => 'Vibo Valentia',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Calabria')->pluck('id')->first()
            ],
            [
                'sigle' => 'VB',
                'name' => 'Verbano-Cusio-Ossola',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Piemonte')->pluck('id')->first()
            ],
            [
                'sigle' => 'OT',
                'name' => 'Olbia Tempio',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'OG',
                'name' => 'Ogliastra',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'VS',
                'name' => 'Medio Campidano',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'CI',
                'name' => 'Carbonia Iglesias',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'MB',
                'name' => 'Monza E Della Brianza',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Lombardia')->pluck('id')->first()
            ],
            [
                'sigle' => 'FM',
                'name' => 'Fermo',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Marche')->pluck('id')->first()
            ],
            [
                'sigle' => 'BT',
                'name' => 'Barletta-Andria-Trani',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Puglia')->pluck('id')->first()
            ],
            [
                'sigle' => 'SU',
                'name' => 'Sud Sardegna',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Sardegna')->pluck('id')->first()
            ],
            [
                'sigle' => 'FU',
                'name' => 'Fiume',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Friuli Venezia Giulia')->pluck('id')->first()
            ],
            [
                'sigle' => 'PL',
                'name' => 'Pola',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Friuli Venezia Giulia')->pluck('id')->first()
            ],
            [
                'sigle' => 'ZA',
                'name' => 'Zara',
                'nation_id' => $idItalyNation,
                'region_id' => Region::where('name', 'Friuli Venezia Giulia')->pluck('id')->first()
            ]
        );

        foreach ($provinces as $province) {
            // creo le province
            $newProvince = new Province();
            $newProvince->name = $province['name'];
            $newProvince->sigle = $province['sigle'];
            $newProvince->nation_id = $province['nation_id'];
            $newProvince->region_id = $province['region_id'];
            $newProvince->save();
        }
    }
}