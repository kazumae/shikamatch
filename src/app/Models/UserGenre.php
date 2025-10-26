<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGenre extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'genre_id',
    ];
}
