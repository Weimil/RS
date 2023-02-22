<?php

namespace Database\Seeders;

use App\Models\Image;
use Database\Factories\ImageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    public function run(): void
    {
        Image::factory()->count(25)->create();
    }
}
