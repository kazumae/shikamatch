<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'artist',
        'artist_id',
        'normalized_title',
        'normalized_artist',
        'youtube_url',
        'match_count',
    ];

    /**
     * Get the artist that owns the song.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
