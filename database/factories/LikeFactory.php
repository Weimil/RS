<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition(): array
    {
        return [
            Like::USER_ID => User::all()->random()->{User::ID},
            Like::IMAGE_ID => Image::all()->random()->{Image::ID}
        ];
    }
}
