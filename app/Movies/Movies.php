<?php

namespace App\Movies;

use Illuminate\Support\Facades\Http;

class Movies
{


    public static function get($path, $query = [])
    {
        return  Http::withOptions(['verify' => false])
            ->get(
                config('services.tmdb.url') . $path,
                [
                    'api_key' => config('services.tmdb.token')
                ] + $query
            )
            ->json();
    }

    public static function getPopularMovies()
    {
        return self::get('/movie/popular');
    }

    public static function getNowPlayingMovies()
    {
        return self::get('/movie/now_playing');
    }

    public static function getGenres()
    {
        return self::get('/genre/movie/list');
    }

    public static function getMovieByID($id)
    {
        return self::get('/movie/' . $id, [
            'append_to_response' => 'credits,videos,images'
        ]);
    }
}
