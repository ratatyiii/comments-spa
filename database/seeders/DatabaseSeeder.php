<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create()->each(function ($user) {

            $commentsCount = rand(1, 5);

            for ($i = 1; $i <= $commentsCount; $i++) {
                $comment = Comment::factory()->create(['user_id' => $user->id, 'username' => $user->username]);

                $repliesCount = rand(0, 3);

                for ($i = 1; $i <= $repliesCount; $i++) {
                    Comment::factory()->hasReplies()->create(['parent_id' => $comment->id]);
                }
            }
        });
    }
}
