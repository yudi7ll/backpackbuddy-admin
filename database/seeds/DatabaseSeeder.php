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
            CategorySeeder::class,
            DistrictSeeder::class,
            ItinerarySeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            CustomerInfoSeeder::class,
            ReviewSeeder::class,
            MediaSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
