<div class="relative mt-3 md:mt-0" x-data="{isOpen: true}" @click.away="isOpen = false">
    {{-- Search bar --}}
    <input
        wire:model.debounce.500ms='search'
        type="text"
        class="w-64 px-4 py-1 pl-8 text-sm bg-gray-800 rounded-full focus:outline-none focus:shadow-inner"
        placeholder="Search"
        @focus="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
        @keydown="isOpen = true"
    >
    {{-- Search Icon --}}
    <div class="absolute top-0">
        <svg class="w-4 mt-2 ml-2 text-gray-500 filled-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div>

    {{-- Search Spinner Icon --}}
    <div wire:loading class="top-0 right-0 mt-3.5 mr-4 spinner"></div>

    {{-- Dropdown List --}}
    @if (strlen($search) > 2)
        <div class="absolute z-50 w-64 mt-4 text-sm text-center bg-gray-800 rounded" x-show.transition.opacity="isOpen">
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                    <li class="border-b border-gray-700">
                        <a href="{{route('movies.show',  $result['id'])}}" class="flex items-center block px-3 py-3 hover:bg-gray-700" @if($loop->last) @keydown.tab.exact="isOpen = false" @endif>
                            @if ($result['poster_path'])
                            <img src="{{'https://image.tmdb.org/t/p/w92/' .$result['poster_path']}}" class="w-8">
                            @else
                            <img src="http://via.placeholder.com/50x75" class="w-8">
                            @endif
                            <span class="ml-4">{{$result['title']}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for {{$search}}</div>
            @endif
        </div>
    @endif
</div>

