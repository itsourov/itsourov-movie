<header class=" border-b bg-white lg:pb-0" x-data="{ mobileMenuOpened: false, isProfileMenuOpen: false }">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- lg+ -->
        <nav class="flex items-center justify-between h-16 lg:h-20">
            <div class="flex-shrink-0">
                <a href="#" title="" class="flex">
                    <img class="w-auto h-8 lg:h-10"
                        src="https://cdn.rareblocks.xyz/collection/celebration/images/logo.svg" alt="" />
                </a>
            </div>

            <div class="flex items-center">

                <button type="button" @click="mobileMenuOpened = !mobileMenuOpened"
                    class="inline-flex p-2 text-black transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100">

                    <svg x-show="!mobileMenuOpened" class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>

                    <svg x-show="mobileMenuOpened" x-cloak class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                @auth

                    <x-user.profile-dropdown class="block lg:hidden" />
                @endauth


            </div>


            <div class="hidden lg:flex lg:items-center lg:ml-auto lg:space-x-10">

                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-nav-link>



                <a href="#" title=""
                    class="text-base  font-medium text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600">
                    Resources </a>

                <a href="#" title=""
                    class="text-base font-medium text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600">
                    Pricing </a>
            </div>
            @auth
                <x-user.profile-dropdown class="hidden lg:block" />
            @else
                <a href="{{ route('login') }}"
                    class="items-center justify-center hidden px-4 py-2 ml-10 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md lg:inline-flex hover:bg-blue-700"
                    role="button"> Log in </a>
            @endauth

        </nav>

        <!-- xs to lg -->
        <nav x-show="mobileMenuOpened" @click.away="mobileMenuOpened = false" x-cloak x-transition
            class="pt-4 pb-6 mb-6 bg-white border border-gray-200 rounded-md shadow-md lg:hidden">
            <div class="flow-root">
                <div class="flex flex-col px-6 -my-2 space-y-1">

                    <a href="#" title=""
                        class="inline-flex py-2 text-base font-medium text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600">
                        Features </a>

                    <a href="#" title=""
                        class="inline-flex py-2 text-base font-medium text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600">
                        Solutions </a>

                    <a href="#" title=""
                        class="inline-flex py-2 text-base font-medium text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600">
                        Resources </a>

                    <a href="#" title=""
                        class="inline-flex py-2 text-base font-medium text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600">
                        Pricing </a>
                </div>
            </div>
            @auth
            @else
                <div class="px-6 mt-6">

                    <a href="{{ route('login') }}"
                        class="inline-flex justify-center px-4 py-2 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md tems-center hover:bg-blue-700 focus:bg-blue-700"
                        role="button"> Get started now </a>

                </div>

            @endauth
        </nav>
    </div>
</header>
