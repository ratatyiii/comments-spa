<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with(['replies.replies', 'replies.user'])
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $user = User::inRandomOrder()->first();

        $comment = Comment::create($request->validated() + ['user_id' => $user->id]);

        return response()->json($comment->toArray() + ['replies' => []]);
    }
}
