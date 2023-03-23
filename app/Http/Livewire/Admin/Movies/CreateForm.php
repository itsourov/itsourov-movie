<?php

namespace App\Http\Livewire\Admin\Movies;

use App\Models\Link;
use App\Models\Movie;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CreateForm extends Component
{


    public $videoSectionOpened = false;
    public $castSectionOpened = false;
    public $crewSectionOpened = false;
    public $linkSectionOpened = true;


    public $movieArray = [
        'tmdb_id' => '',
        'title' => '',
        'original_title' => '',
        'is_adult' => '',
        'release_date' => '',
        'runtime' => '',
        'images' => '',
        'poster' => '',
        'backdrop' => '',
        'trailers' => [],
        'rating' => '',
        'cast' => [],
        'crew' => [],
        'synopsis' => '',
    ];
    public $links = [];


    protected $rules = [

        'movieArray.tmdb_id' =>  'unique:movies,tmdb_id',
        'movieArray.title' =>  'required',
        'movieArray.original_title' =>  'required',
        'movieArray.is_adult' =>  '',
        'movieArray.release_date' =>  'date',
        'movieArray.images' =>  '',
        'movieArray.trailers' =>  '',
        'movieArray.cast' =>  '',
        'movieArray.crew' =>  '',
        'movieArray.poster' =>  '',
        'movieArray.backdrop' =>  '',
        'movieArray.synopsis' =>  '',
        'movieArray.rating' =>  '',
        'movieArray.runtime' =>  '',
    ];

    public function render()
    {
        return view('livewire.admin.movies.create-form');
    }
    // public function mount()
    // {
    //     $this->getInfo();
    // }
    public function videoSectionToggle()
    {
        $this->videoSectionOpened = !$this->videoSectionOpened;
    }
    public function castSectionToggle()
    {
        $this->castSectionOpened = !$this->castSectionOpened;
    }
    public function crewSectionToggle()
    {
        $this->crewSectionOpened = !$this->crewSectionOpened;
    }
    public function linkSectionToggle()
    {
        $this->linkSectionOpened = !$this->linkSectionOpened;
    }
    public function removeVideo($index)
    {

        unset($this->movieArray['trailers'][$index]);
    }
    public function removeCast($index)
    {

        unset($this->movieArray['cast'][$index]);
    }
    public function removeCrew($index)
    {

        unset($this->movieArray['crew'][$index]);
    }
    public function removeLink($index)
    {

        unset($this->links[$index]);
    }
    public function addNewVideo()
    {
        array_push($this->movieArray['trailers'], []);
    }
    public function addNewCast()
    {
        array_push($this->movieArray['cast'], [
            'profile_path' => '',
            'name' => '',
            'character' => '',
        ]);
    }
    public function addNewCrew()
    {
        array_push($this->movieArray['crew'], ['job' => 'Director']);
    }
    public function addNewLink()
    {
        array_push($this->links, ['value' => '', 'type' => 'Download', 'quality' => '720p', 'language' => 'English']);
    }


    public function getInfo()
    {
        $this->validate(['movieArray.tmdb_id' => ['required']]);
        $movieid = $this->movieArray['tmdb_id'];
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
            return $this->addError('movieArray.tmdb_id', 'Invalid id');
        }



        $movie = $movieJson;





        $this->movieArray =    [
            'tmdb_id' => $movie->id,
            'title' => $movie->title,
            'original_title' => $movie->title,
            'is_adult' => $movie->adult,
            'release_date' => $movie->release_date,
            'runtime' => $movie->runtime,
            'images' => ($movie->image->backdrops),
            'poster' => $movie->poster_path,
            'backdrop' => $movie->backdrop_path,
            'trailers' => ($movie->video->results),
            'rating' => ($movie->vote_average),
            'cast' => ($movie->credits->cast),
            'crew' => ($movie->credits->crew),
            'synopsis' => ($movie->overview),
        ];
    }


    public function SaveNewMovie()
    {


        $validatedData =  $this->validate();
        if (empty($validatedData['movieArray']['tmdb_id'])) {
            $validatedData['movieArray']['tmdb_id'] = null;
        }
        $this->validate([
            'links' => 'required|array|min:1', // Will make sure the the product_options is an array and has at least one element
            'links.*.value' =>  'required|min:3',
        ]);


        DB::beginTransaction();


        $newMovie =   Movie::create($validatedData['movieArray']);

        foreach ($this->links as  $link) {

            if (!$link['value']) {
                return $this->addError('linkError', 'Link value is empty');
            }

            Link::create(array_merge($link, ['movie_id' => $newMovie->id]));
        }
        DB::commit();
        return redirect(route('movies.show', $newMovie->id));
    }
}
