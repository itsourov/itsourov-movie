<x-app-layout>
    <div class="container mx-auto px-2 mt-5">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="flex justify-center ">
                <a href="https://image.tmdb.org/t/p/original{{ $movie->poster_path }}" class="spotlight">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt=""
                        class=" rounded shadow w-full max-w-sm">
                </a>

            </div>
            <div class="md:col-span-2 lg:col-span-2 space-y-3">
                <p class=" text-xl text-yellow-400 font-bold">{{ date('M. d, Y', strtotime($movie->release_date)) }}</p>
                <h2 class=" text-3xl font-bold" style="font-family: 'Lora', serif;">{{ $movie->title }}</h2>
                <div class="flex items-center gap-3">
                    <div class="bg-gray-100 text-sm  p-1 rounded">
                        PG 18
                    </div>
                    <p class="text-sm text-gray-500">{{ date('M. d, Y', strtotime($movie->release_date)) }}</p>

                    <div class="flex divide-x">
                        @foreach ($movie->genres as $genre)
                            <a href="/" class="hover:text-primary-600 px-2">{{ $genre->name }}</a>
                        @endforeach
                    </div>

                </div>
                <p><span class=" text-orange-400">Runtime:</span> {{ $movie->runtime }} min</p>
                <p>{{ $movie->overview }}</p>

                <div class="bg-gray-100 rounded p-2 ">
                    <div>
                        <p class="text-gray-700">Watch videos:</p>
                        <p class="text-gray-700 text-sm">Clips and trailer</p>
                    </div>

                    @foreach ($movie->video->results as $video)
                        <x-button.primary>{{ $video->type }}</x-button.primary>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
