<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Padlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isPublic',
        'published',
        'user_id',
    ];


    /**
     * user has many padlets
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entries() : HasMany
    {
        return $this->hasMany(Entry::class);
    }

}
