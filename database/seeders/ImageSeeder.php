<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/json/image.json'), true);
        $this->migrate($data);
    }

    public function migrate($data)
    {
        foreach ($data as $item) {
            $user = Image::create($item);
        }
    }
}
