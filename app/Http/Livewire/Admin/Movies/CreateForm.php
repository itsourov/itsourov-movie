<?php

namespace App\Http\Livewire\Admin\Movies;

use App\Models\Link;
use App\Models\Movie;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreateForm extends Component
{

    public $tmdb_id = '776835';
    public $title = "";
    public $original_title = "";
    public $release_date, $runtime, $backdrop, $poster, $rating, $synopsis;

    public $array = [];

    protected $rules = [
        'tmdb_id' => 'required',

    ];


    public function render()
    {
        return view('livewire.admin.movies.create-form');
    }

    public function getInfo()
    {
        $this->validate();
        $movieid = $this->tmdb_id;
        $movieJson = cache()->remember($movieid, 60 * 60, function () use ($movieid) {

            $movieRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid);
            if (!$movieRes->successful()) {
                return false;
            }
            $imageRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '/images');
            $videoRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '/videos');
            $creditRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid . '/credits');

            $movieJson =  json_decode($movieRes);
            $creditJson =  json_decode($creditRes);
            $videoJson =  json_decode($videoRes);
            $imageJson =  json_decode($imageRes);

            $movieJson->credits = $creditJson;
            $movieJson->video = $videoJson;
            $movieJson->image = $imageJson;

            return $movieJson;
        });
        if (!$movieJson) {
            return $this->addError('tmdb_id', 'Invalid id');
        }



        $movie = $movieJson;

        $this->title = $movie->title;
        $this->original_title = $movie->title;
        $this->release_date = $movie->release_date;
        $this->runtime = $movie->runtime;
        $this->poster = $movie->poster_path;
        $this->backdrop = $movie->backdrop_path;
        $this->rating = $movie->vote_average;
        $this->synopsis = $movie->overview;


        // $newMovie =    Movie::create([
        //     'tmdb_id' => $movie->id,
        //     'title' => $movie->title,
        //     'original_title' => $movie->title,
        //     'is_adult' => $movie->adult,
        //     'release_date' => $movie->release_date,
        //     'runtime' => $movie->runtime,
        //     'images' => ($movie->image->backdrops),
        //     'poster' => $movie->poster_path,
        //     'backdrop' => $movie->backdrop_path,
        //     'trailers' => ($movie->video->results),
        //     'rating' => ($movie->vote_average),
        //     'cast' => ($movie->credits->cast),
        //     'crew' => ($movie->credits->crew),
        //     'synopsis' => ($movie->overview),
        // ]);

        // for ($i = 0; $i < 3; $i++) {
        //     Link::create([
        //         'value' => 'https://google.com',
        //         'movie_id' => $newMovie->id,
        //     ]);
        // }
    }
}
