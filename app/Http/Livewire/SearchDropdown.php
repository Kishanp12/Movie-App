<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;



class SearchDropdown extends Component
{
    public $search = "";


    public function render()
    {
        //Creating an array to hold the movies
        $searchResults = [];

        //IF statement for search box to have more then 2 letters in it then to call api
        if (strlen($this->search) > 2) {

            $searchResults = Http::withOptions(['verify' => false])->get('https://api.themoviedb.org/3/search/movie', ['api_key' => '69b90cb6d369653405555904c529449a', 'query' => $this->search])
                ->json()['results'];
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(7)
        ]);
    }
}
