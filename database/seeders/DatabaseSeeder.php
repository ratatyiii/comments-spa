<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create()->each(function ($user) {
            $comment = Comment::factory()->create(['user_id' => $user->id, 'username' => $user->username]);

            Comment::factory(2)->hasReplies()->create(['parent_id' => $comment->id]);
        });
    }
}
