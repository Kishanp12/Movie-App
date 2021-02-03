<?php

namespace App\Http\Controllers;

use App\Movies\Movies;
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
        $popularMovies = Movies::getPopularMovies()['results'];

        // Now Playing Movies From API
        $nowPlayingMovies = Movies::getNowPlayingMovies()['results'];

        //Getting Genres from API
        $genres = Movies::getGenres()['genres'];


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

        $movie = Movies::getMovieByID($id);

        $viewModel = new MovieViewModel($movie);

        return view('movies.show', $viewModel);
    }
}
