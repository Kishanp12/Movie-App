<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{

    public function index()
    {
        //Getting Popular Movies from API
        $popularMovies = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/movie/popular', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['results'];



        // Now Playing Movies From API
        $nowPlayingMovies = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/movie/now_playing', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['results'];


        //Getting Genres from API
        $genres = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/genre/movie/list', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['genres'];


        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );

        return view('movies.index', $viewModel);
    }


    public function show($id)
    {
        //Getting Movie Details from API
        $movie = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/movie/' . $id, ['api_key' => '69b90cb6d369653405555904c529449a', 'append_to_response' => 'credits,videos,images'])
            ->json();

        $viewModel = new MovieViewModel($movie);

        return view('movies.show', $viewModel);
    }
}
