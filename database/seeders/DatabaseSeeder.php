<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $comments = Comment::factory(100)
            ->create();

        $comments->each(function (Comment $comment) {
            $comment->replies()->saveMany(Comment::factory(rand(1, 2))
                ->hasReplies(rand(0, 1))
                ->create());
        });
    }
}
