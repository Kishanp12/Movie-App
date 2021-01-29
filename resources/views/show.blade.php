@extends('layouts.main')

@section('content')

{{-- Movie Detail --}}
    <div class="border-b border-gray-800 movie-info">
        <div class="container flex flex-col px-4 py-16 mx-auto md:flex-row">
            {{-- Left Side --}}
            <img src="{{'https://image.tmdb.org/t/p/w500/' .$movie['poster_path']}}" alt="parasite" class="w-64 lg:w-96">
            {{-- Right Side --}}
            <div class="md:ml-24">
               <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>
                <div class="flex flex-wrap items-center text-sm text-gray-400">
                        <svg class="w-4 text-yellow-600 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        <span class="ml-1">{{$movie['vote_average']}}</span>
                        <span class="mx-2">|</span>
                        <span>{{\Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')}}</span>
                        <span class="mx-2">|</span>
                        <span>
                            @foreach ($movie['genres'] as $genre)
                                {{$genre['name']}}@if(!$loop->last), @endif
                            @endforeach
                        </span>
                </div>

               <p class="mt-8 text-gray-300">
                   {{$movie['overview']}}
               </p>

               <div class="mt-12">
                   <h4 class="font-semibold text-white">Featured Cast</h4>
                   <div class="flex mt-4">
                       @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 2)
                            <div class="mr-8">
                                <div>{{$crew['name']}}</div>
                                <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                            </div>
                        @endif
                       @endforeach

                   </div>
               </div>
               {{-- Button for Trailer --}}
               <div x-data="{isOpen: false}">
                @if (count($movie['videos']['results']) > 0)
                    <div class="mt-12">
                        <button class="flex inline-flex items-center px-5 py-4 font-semibold text-gray-900 transition duration-150 ease-in-out bg-yellow-500 rounded hover:bg-yellow-600" @click="isOpen = true">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="ml-2"> Play Trailer</span>
                        </button>
                    </div>
                @endif

                {{-- Modal PopUp for Movie Trailer --}}
                    <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 flex items-center w-full h-full overflow-y-auto shadow-lg" x-show="isOpen">
                    <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pt-2 pr-4">
                                <button
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="px-8 py-8 modal-body">
                                <div class="relative overflow-hidden responsive-container" style="padding-top: 56.25%">
                                    <iframe class="absolute top-0 left-0 w-full h-full responsive-iframe" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                    {{-- End PopUp --}}
                </div>
            </div>

{{-- End Movie Detail --}}

{{-- Movie Cast--}}
    <div class="border-b border-gray-800 movie-cast">
        <div class="container px-4 py-16 mx-auto">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">

                @foreach ($movie['credits']['cast'] as $cast)
                     @if ($loop->index < 5)
                        <div class="mt-8">
                            <a href="#">
                                <img src="{{'https://image.tmdb.org/t/p/w300/' .$cast['profile_path']}}" alt="" class="duration-150 hover:opacity-75 transition-ease-in-out">
                            </a>
                            <div class="mt-2">
                                <a href="#" class="mt-2 text-lg hover:text-gray-300">{{$cast['name']}}</a>
                                <div class="text-sm text-gray-400">
                                    {{$cast['character']}}
                                </div>
                            </div>
                        </div>
                        @endif
                @endforeach

            </div>
        </div>
    </div>
    {{-- End Cast --}}

    {{-- Images --}}
    <div class="border-b border-gray-800 movie-Images">
        <div class="container px-4 py-16 mx-auto">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                @foreach ($movie['images']['backdrops'] as $image)
                     @if ($loop->index < 9)
                        <div class="mt-8">
                            <a href="#">
                                <img src="{{'https://image.tmdb.org/t/p/w500/' .$image['file_path']}}" alt="" class="duration-150 hover:opacity-75 transition-ease-in-out">
                            </a>
                        </div>
                     @endif
                @endforeach

            </div>
        </div>
    </div>
@endsection
