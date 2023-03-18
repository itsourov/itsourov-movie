<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $response = cache()->remember('popular-movies', 60 * 60, function () {

            $response = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular');

            return json_decode($response);
        });

        dump($response);
        return view('welcome', [
            'response' => $response,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($movieid)
    {

        $movieJson = cache()->remember($movieid, 60 * 60, function () use ($movieid) {

            $movieRes = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $movieid);
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


        // dump($movieJson);


        return view('movies.show', [
            'movie' => $movieJson,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
