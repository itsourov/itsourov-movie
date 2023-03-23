<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-white text-gray-900 dark:text-gray-100 dark:bg-gray-900 antialiased">
    @include('inc.navbar')
    <main>
        {{ $slot }}
    </main>
    @include('inc.footer')

    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/view-all-cast.js') }}"></script>
    @yield('scripts')
    @livewireScripts
</body>

</html>
