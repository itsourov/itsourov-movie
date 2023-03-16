    <x-dropdown align="right" width="48" class="{{ $class }}">
        <x-slot name="trigger">
            <button type="button"
                class=" ml-2 lg:ml-6  inline-flex  text-black transition-all duration-200 rounded-full  focus:bg-gray-100 hover:bg-gray-100">

                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full border  border-primary-400"
                    src="{{ auth()->user()->getMedia('profileImages')->last()? auth()->user()->getMedia('profileImages')->last()->getUrl('small'): asset('images/user.png') }}"
                    alt="">
            </button>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>
            @if (auth()->user()->role == 'admin')
                {{-- <x-dropdown-link :href="route('admin')">
                    {{ __('Admin Panel') }}
                </x-dropdown-link> --}}
            @endif

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
