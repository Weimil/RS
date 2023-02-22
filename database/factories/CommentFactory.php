<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            Comment::USER_ID => User::all()->random()->{User::ID},
            Comment::IMAGE_ID => Image::all()->random()->{Image::ID},
            Comment::CONTENT => fake()->sentence(),
        ];
    }
}
