<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the profile associated with the user.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * The parts that belong to the user.
     */
    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class, 'user_parts')
            ->withPivot('is_sub')
            ->withTimestamps();
    }

    /**
     * The genres that belong to the user.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'user_genres')
            ->withTimestamps();
    }

    /**
     * The music preferences that belong to the user.
     */
    public function musicPreferences(): BelongsToMany
    {
        return $this->belongsToMany(MusicPreference::class, 'user_music_preferences')
            ->withTimestamps();
    }

    /**
     * The songs to copy that belong to the user.
     */
    public function songsToCopy(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'user_songs_to_copy')
            ->withTimestamps();
    }

    /**
     * The favorite artists that belong to the user.
     */
    public function favoriteArtists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'user_favorite_artists')
            ->withTimestamps();
    }
}
