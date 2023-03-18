<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tmdb_id',
        'title',
        'original_title',
        'is_adult',
        'release_date',
        'runtime',
        'rating',
        'images',
        'poster',
        'backdrop',
        'trailers',
        'cast',
        'crew',
        'synopsis',
    ];

    protected $casts = [
        'images' => 'array',
        'trailers' => 'array',
        'cast' => 'array',
        'crew' => 'array',
    ];

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
