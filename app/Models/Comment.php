<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'username',
        'email',
        'home_page',
        'text',
    ];

    protected $hidden = [
        'user_id',
        'updated_at'
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('H:i:s d-m-Y');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
//        return $this->hasMany(CommentReply::class);
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }


}
