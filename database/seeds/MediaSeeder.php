<?php

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = Storage::disk('public')->allFiles('samples');
        $data = [];

        foreach ($files as $key => $file) {
            $data[$key]['name'] = last(explode('/', $file));
            $data[$key]['file_size'] = 0;
            $data[$key]['alt'] = 'Itinerary ' . $data[$key]['name'];
            $data[$key]['type'] = 'Itinerary';
        }

        DB::table('media')->insert($data);
    }
}
