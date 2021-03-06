@extends('layouts.main')

@section('content')

<div class="container px-4 pt-16 mx-auto">
    <div class="popular movies">
        <h2 class="text-lg font-semibold tracking-wider text-yellow-600 uppercase">Popular Shows</h2>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">

            @foreach ($popularTv as $tvshow)
               <x-tv-card :tvshow='$tvshow'/>
            @endforeach

        </div>
    </div>

    <div class="py-24 now-playing-movies">
        <h2 class="text-lg font-semibold tracking-wider text-yellow-600 uppercase">Top Rated Shows</h2>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">

            @foreach ($topRatedTv as $tvshow)
                <x-tv-card :tvshow='$tvshow'/>
            @endforeach

        </div>
    </div>
</div>
@endsection
