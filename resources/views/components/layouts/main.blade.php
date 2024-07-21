<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    {{-- Fonts  --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite('resources/css/app.css')

    {{-- Template Styling --}}
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard-tailwind.min.css') }}">

</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">

    <x-sidebar.sidenav />

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">

        <x-navbar.nav :title="$title" />

        <div class="w-full px-6 py-6 mx-auto">

            {{ $slot }}

            <x-footer.footer />

        </div>
    </main>

    <script src="{{ asset('assets/js/argon-dashboard-tailwind.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/navbar-sticky.js') }}"></script>
    <script src="{{ asset('assets/js/sidenav-burger.js') }}"></script>
    @livewireScripts
</body>

</html>
