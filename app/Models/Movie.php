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
    public function poster($size)
    {
        if (!$this->poster) {
            return 'https://www.themoviedb.org/assets/2/apple-touch-icon-cfba7699efe7a742de25c28e08c38525f19381d31087c69e89d6bcb8e3c0ddfa.png';
        }
        if (str_contains($this->poster, 'https://') || str_contains($this->poster, 'http://')) {
            return $this->poster;
        }
        return 'https://image.tmdb.org/t/p/' . ($size ?? 'orginal') . $this->poster;
    }
}
