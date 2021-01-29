<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Getting Popular Movies from API
        $popularMovies = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/movie/popular', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['results'];



        // Now Playing Movies From API
        $nowPlayingMovies = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/movie/now_playing', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['results'];


        //Getting Genres from API
        $genreArray = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/genre/movie/list', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['genres'];

        //Creating a collection so the ID equals the Genre Name (Key = ID, Value = Name)
        $genres = collect($genreArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });





        return view('index', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Getting Movie Details from API
        $movie = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/movie/' . $id, ['api_key' => '69b90cb6d369653405555904c529449a', 'append_to_response' => 'credits,videos,images'])
            ->json();


        return view('show', [
            'movie' => $movie,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
