<div class="mt-8">
    <a href="{{ route('movies.show', $movie['id'] )}}">
        <img src=" {{'https://image.tmdb.org/t/p/w500/' .$movie['poster_path']}}" alt="poster" class="duration-150 hover:opacity-75 transition-ease-in-out">
    </a>
    <div class="mt-2">
        <a href="{{route('movies.show', $movie['id'])}}" class="mt-2 text-lg hover:text-gray-300">{{$movie['title']}}</a>
        <div class="flex items-center mt-1 text-sm text-gray-400">
            <svg class="w-4 text-yellow-600 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            <span class="ml-1">{{$movie['vote_average']}}</span>
            <span class="mx-2">|</span>
            <span>{{\Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')}}</span>
        </div>
        <div class="text-sm text-gray-400">
            @foreach ($movie['genre_ids'] as $genre)
                {{$genres->get($genre)}}@if(!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div>
