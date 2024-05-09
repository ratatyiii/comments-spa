<?php

use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('comments', CommentController::class)
    ->except(['create', 'show', 'edit', 'update', 'destroy'])
    ->middleware([HandlePrecognitiveRequests::class]);
