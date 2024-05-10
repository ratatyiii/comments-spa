<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'home_page' => fake()->optional()->url(),
            'text' => fake()->realText(),
            'image'=> fake()->optional()->imageUrl(320, 240),
            'file' => fake()->optional()->url(),
            'updated_at' => fake()->dateTimeThisYear(),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
