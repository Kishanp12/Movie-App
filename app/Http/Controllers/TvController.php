<?php

namespace App\Http\Controllers;

use App\Tv\Tv;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{

    public function index()
    {

        //Getting Popular Movies from API
        $popularTv = Tv::getPopularTv()['results'];

        // Now Playing Movies From API
        $topRatedTv = Tv::getTopRatedTv()['results'];

        //Getting Genres from API
        $genres = Tv::getTvGenres()['genres'];

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    public function show($id)
    {
        //Getting Movie Details from API
        $tvshow = Tv::getTvByID($id);

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);
    }
}
