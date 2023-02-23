<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Comment;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            Image::USER_ID => User::all()->random()->{User::ID},
            Image::IMAGE_PATH => 'default.png',
            Image::DESCRIPTION => fake()->sentence(),
        ];
    }
}
