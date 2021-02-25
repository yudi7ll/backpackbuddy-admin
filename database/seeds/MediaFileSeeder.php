<?php

use Illuminate\Database\Seeder;

class MediaFileSeeder extends Seeder
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
            $data[$key]['uri'] = Storage::disk('public')->url($file);
            $data[$key]['name'] = $key + 1;
            $data[$key]['path'] = $file;
            $data[$key]['file_size'] = 0;
        }

        DB::table('media_files')->insert($data);
    }
}
