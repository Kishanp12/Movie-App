<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{

    public function index()
    {

        //Getting Popular Movies from API
        $popularTv = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/tv/popular', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['results'];



        // Now Playing Movies From API
        $topRatedTv = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/tv/top_rated', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['results'];


        //Getting Genres from API
        $genres = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/genre/tv/list', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json()['genres'];


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
        $tvshow = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/tv/' . $id, ['api_key' => '69b90cb6d369653405555904c529449a', 'append_to_response' => 'credits,videos,images'])
            ->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);
    }
}
