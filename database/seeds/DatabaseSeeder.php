<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
            RegionsSeeder::class,
            ProvincesSeeder::class,
            CitiesSeeder::class,
            CategoriesSeeder::class,
            SizesSeeder::class,
            GenresSeeder::class,
            ColorsSeeder::class,
            ProductsSeeder::class,
        ]);
    }
}