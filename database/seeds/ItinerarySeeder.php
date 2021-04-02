<?php

use App\Category;
use App\District;
use App\Itinerary;
use Illuminate\Database\Seeder;

class ItinerarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Itinerary::class, 200)->create();
        $districts = District::all();
        $categories = Category::all();

        Itinerary::all()->each(function ($itinerary) use ($districts, $categories) {
            // populate default media
            $itinerary->media()->attach(1, ['isFeatured' => true]);

            // populate districts
            $itinerary->districts()->sync(
                $districts->random(rand(1, 3))->pluck('id')->toArray()
            );
            // populate categories
            $itinerary->categories()->sync(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
