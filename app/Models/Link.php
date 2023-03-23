<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'movie_id',
        'type',
        'quality',
        'language',
        'click_count',
        'value',

    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
