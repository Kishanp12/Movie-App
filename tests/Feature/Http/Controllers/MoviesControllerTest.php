<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MoviesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->popularResponse(),
        ]);


        $response = $this->get('/');

        $response->assertStatus(200);
    }

    private function popularResponse()
    {
        return Http::response([

            'page' => 1,
            'total_pages' => 1,
            'total_results' => 1,
            'results' => [
                [
                    "adult" =>  false,
                    "backdrop_path" =>  "/lOSdUkGQmbAl5JQ3QoHqBZUbZhC.jpg",
                    "genre_ids" =>  [
                        53,
                        28,
                        878
                    ],
                    "id" =>  775996,
                    "original_language" =>  "en",
                    "original_title" =>  "Outside the Wire",
                    "overview" =>  "In the near future, a drone pilot is sent into a deadly militarized zone and must work with an android officer to locate a doomsday device.",
                    "popularity" =>  3435.973,
                    "poster_path" =>  "/e6SK2CAbO3ENy52UTzP3lv32peC.jpg",
                    "release_date" =>  "2021-01-15",
                    "title" =>  "Outside the Wire",
                    "video" =>  false,
                    "vote_average" =>  6.5,
                    "vote_count" =>  544
                ]
            ]
        ], 200);
    }
}
