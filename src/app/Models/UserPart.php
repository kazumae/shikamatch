<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'part_id',
        'is_sub',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_sub' => 'boolean',
    ];
}
