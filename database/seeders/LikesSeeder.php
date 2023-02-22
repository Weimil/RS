<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    public function run(): void
    {
        Like::factory()->count(25)->create();
    }
}
