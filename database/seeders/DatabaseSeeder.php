<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Link;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $response = cache()->remember('popular-movies', 60 * 60, function () {

            $response = Http::accept('application/json')->withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular');

            return json_decode($response);
        });

        foreach ($response->results as $movie) {
            $movieid = $movie->id;
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

            $movie = $movieJson;
            $newMovie =    Movie::create([
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
            ]);

            for ($i = 0; $i < 3; $i++) {
                Link::create([
                    'value' => 'https://google.com',
                    'movie_id' => $newMovie->id,
                ]);
            }
        }
    }
}
