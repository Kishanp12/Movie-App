<?php

namespace App\Tv;

use Illuminate\Support\Facades\Http;

class Tv
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

    public static function getPopularTv()
    {
        return self::get('/tv/popular');
    }

    public static function getTopRatedTv()
    {
        return self::get('/tv/top_rated');
    }

    public static function getTvGenres()
    {
        return self::get('/genre/tv/list');
    }

    public static function getTvByID($id)
    {
        return self::get('/tv/' . $id, [
            'append_to_response' => 'credits,videos,images'
        ]);
    }
}
