<x-app-layout>
    <div class="container mx-auto px-2 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @include('profile.partial.profile-info-update')
            <div class="grid gap-6">
                @include('profile.partial.password-change')
                @include('profile.partial.delete-user')
            </div>

        </div>
    </div>



</x-app-layout>
