<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{

    public function index($page = 1)
    {
        $popularActors = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/person/popular', ['api_key' => '69b90cb6d369653405555904c529449a', 'page' => $page])
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('actors.index', $viewModel);
    }


    public function show($id)
    {
        $actor = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/person/' . $id, ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json();

        $social = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json();

        $credits = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits', ['api_key' => '69b90cb6d369653405555904c529449a'])
            ->json();

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('actors.show', $viewModel);
    }
}
