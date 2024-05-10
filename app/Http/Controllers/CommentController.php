<?php

namespace App\Http\Controllers;

use App\Events\CommentAddEvent;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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
        $user = User::factory()->create();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->resize(320, 240);

            $path = 'comments/images/'.Str::random(40).'.'.$file->getClientOriginalExtension();

            Storage::disk('public')->put($path, $image->encode());

            $data['image'] = '/storage/'.$path;
        }

        if ($request->hasFile('file')) {
            $data['file'] = '/storage/'.$request->file('file')->store('comments/files', 'public');
        }

        $comment = Comment::create($data)->refresh();

        CommentAddEvent::dispatch($comment);

        return response()->json(['message' => 'Комментарий успешно создан']);
    }
}
