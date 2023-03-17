<x-app-layout>
    <section class="bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                    <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl">Sign up to
                        {{ config('app.name') }}</h2>
                    <p class="mt-2 text-base text-gray-600">Already have an account? <a href="{{ route('login') }}"
                            title=""
                            class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 hover:underline focus:text-blue-700">Login</a>
                    </p>

                    <div class="mt-8 space-y-3">
                        <x-social-login-button.google />
                        <x-social-login-button.facebook />
                    </div>
                    <form action="{{ route('register') }}" method="POST" class="mt-6">
                        @csrf
                        <div class="space-y-5">
                            <div>


                                <x-input.label>Full Name</x-input.label>

                                <x-input.text class="p-4" type="text" name="name"
                                    placeholder="Enter your full name" />

                                <x-input.error :messages="$errors->get('name')" />
                            </div>

                            <div>


                                <x-input.label>Email address</x-input.label>

                                <x-input.text class="p-4" type="email" name="email"
                                    placeholder="Enter email to get started" />

                                <x-input.error :messages="$errors->get('email')" />
                            </div>

                            <div>

                                <x-input.label>Password</x-input.label>

                                <x-input.text class="p-4" type="password" name="password"
                                    placeholder="Enter your password" />

                                <x-input.error :messages="$errors->get('password')" />
                            </div>
                            <div>

                                <x-input.label>Confirm password</x-input.label>

                                <x-input.text class="p-4" type="password_confirmation" name="password_confirmation"
                                    placeholder="Confirm your password" />

                                <x-input.error :messages="$errors->get('password_confirmation')" />
                            </div>

                            <div class="flex items-center">


                                <label for="agree" class=" text-sm font-medium text-gray-500">
                                    By clicking the button below I agree to {{ config('app.name') }}’s <a href="#"
                                        title="" class="text-blue-600 hover:text-blue-700 hover:underline">Terms
                                        of Service</a>
                                    and <a href="#" title=""
                                        class="text-blue-600 hover:text-blue-700 hover:underline">Privacy Policy</a>
                                </label>
                            </div>

                            <div>

                                <x-button.primary class="w-full py-4 px-4">Create free account</x-button.primary>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

            <div
                class="flex
                                    items-center justify-center px-4 py-10 sm:py-16 lg:py-24 bg-gray-50 sm:px-6
                                    lg:px-8">
                <div>
                    <img class="w-full mx-auto"
                        src="https://cdn.rareblocks.xyz/collection/celebration/images/signup/1/cards.png"
                        alt="" />

                    <div class="w-full max-w-md mx-auto xl:max-w-xl">
                        <h3 class="text-2xl font-bold text-center text-black">Design your own card
                        </h3>
                        <p class="leading-relaxed text-center text-gray-500 mt-2.5">Amet minim
                            mollit non deserunt
                            ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis.
                        </p>

                        <div class="flex items-center justify-center mt-10 space-x-3">
                            <div class="bg-orange-500 rounded-full w-20 h-1.5"></div>

                            <div class="bg-gray-200 rounded-full w-12 h-1.5"></div>

                            <div class="bg-gray-200 rounded-full w-12 h-1.5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</x-app-layout>
