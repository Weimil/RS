<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(ImagesSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(LikesSeeder::class);
    }
}
