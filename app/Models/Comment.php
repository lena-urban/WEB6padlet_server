<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'rating',
        'entry_id',
        'user_id',
    ];

    public function comment() : BelongsTo
    {
        return $this->belongsTo(Entry::class);
    }
}
