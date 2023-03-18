<x-app-layout>
    <title>{{ $movie->title }}</title>
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


            </div>
        </div>
        <div class="mt-5 border-t border-b py-2">
            <div class="grid grid-cols-2 gap-1 md:block md:space-y-1">
                <button class="rounded bg-gray-100 px-4 py-1.5 transition-all duration-200 tab-btn"
                    data-target="info-container">Info</button>
                <button class="rounded bg-gray-100 px-4 py-1.5 ransition-all duration-200 tab-btn"
                    data-target="casts-container">Casts</button>
                <button class="rounded bg-gray-100 px-4 py-1.5 ransition-all duration-200 tab-btn"
                    data-target="trailer-container">Trailer</button>
                <button class="rounded bg-gray-100 px-4 py-1.5 ransition-all duration-200 tab-btn"
                    data-target="links-container">Links</button>

            </div>

        </div>

        <div class="mt-3 space-y-4 ">
            <div id="info-container" class="tab-content">
                <h4 class="text-base font-bold">Synopsis</h4>
                <p>{{ $movie->overview }}</p>

                <hr class="my-5">

                <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4">

                    @foreach ($movie->image->backdrops as $index => $image)
                        <a href="https://image.tmdb.org/t/p/original{{ $image->file_path }}"
                            class="spotlight singel-image"
                            @if ($index > 7) style="display:none" @endif>
                            <img src="https://image.tmdb.org/t/p/w500{{ $image->file_path }}" alt=""
                                class=" rounded shadow ">
                        </a>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <button class="hover:text-primary-500" id="viewAllImageButton">View
                        all</button>
                </div>
            </div>
            <div id="casts-container" class="tab-content" style="display:none;">
                <h4 class="text-base font-bold">Director</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2  mt-2">
                    @foreach ($movie->credits->crew as $cast)
                        @if ($cast->job == 'Director')
                            <div class="border rounded p-2  flex flex-wrap md:flex-nowrap md:space-x-2">

                                <img src="{{ $cast->profile_path ? 'https://image.tmdb.org/t/p/w500' . $cast->profile_path : 'https://movies.itsourov.com/wp-content/themes/dooplay/assets/img/no/cast.png' }}"
                                    alt="" class=" object-cover w-full md:w-1/3 rounded shadow">
                                <div class="">
                                    <p class="text-md font-bold">{{ $cast->name }}</p>
                                    <p class=" font-light text-sm">{{ $cast->job }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="flex justify-between">
                    <h4 class="text-base font-bold mt-5">Casts</h4>
                    <button class="hover:text-primary-500" id="viewAllCasttButton">View
                        all</button>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2  mt-2">
                    @foreach ($movie->credits->cast as $index => $cast)
                        <div class="border rounded p-2  flex flex-wrap md:flex-nowrap md:space-x-2 singel-cast"
                            @if ($index > 9) style="display:none" @endif>

                            <img src="{{ $cast->profile_path ? 'https://image.tmdb.org/t/p/w500' . $cast->profile_path : 'https://movies.itsourov.com/wp-content/themes/dooplay/assets/img/no/cast.png' }}"
                                alt="" class=" object-cover w-full md:w-1/3 rounded shadow">
                            <div class="">
                                <p class="text-md font-bold">{{ $cast->name }}</p>
                                <p class=" font-light text-sm">{{ $cast->character }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="trailer-container" class="tab-content" style="display:none;">
                <h4 class="text-base font-bold">Videos</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <div class=" md:col-span-2">
                        <div class="video-container">


                            <iframe id="trailerVideoPreview"
                                src="https://www.youtube.com/embed/{{ end($movie->video->results)->key }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="relative overflow-hidden1">
                        <div class="space-y-3 grid grid-cols-1 overflow-y-scroll h-[60vh] border p-1">
                            @foreach ($movie->video->results as $video)
                                <button class="border rounded p-2 flex gap-4 trailers-video-btn"
                                    data-id="{{ $video->key }}">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z">
                                        </path>
                                    </svg>
                                    <p class=" truncate"> <span class="font-bold">{{ $video->type }}</span> -
                                        {{ $video->name }}</p>
                                </button>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class=" mt-10 space-y-4" id="links">
            <h4 class="text-lg font-bold ">Links</h4>

            <div class="links pb-5">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Options</th>
                                            <th scope="col"
                                                class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quality</th>
                                            <th scope="col"
                                                class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Language</th>
                                            <th scope="col"
                                                class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Clicks</th>
                                            <th scope="col"
                                                class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Updated</th>
                                            {{-- <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Odd row -->
                                        <tr class="bg-white">
                                            <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <button type="button" data-te-ripple-init
                                                    data-te-ripple-color="light"
                                                    class="inline-block rounded bg-primary-500 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
                                                    Click me
                                                </button>
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-xs font-bold text-gray-500">
                                                <p class="border rounded w-min p-1">720P</p>
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">English</td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">1</td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">4 days ago
                                            </td>
                                            {{-- <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#"
                                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td> --}}
                                        </tr>



                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    @include('movies.inc.how-it-works')

</x-app-layout>
