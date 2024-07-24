<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} | {{ $title }}</title>

    {{-- Fonts  --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite('resources/css/app.css')

    {{-- Template Styling --}}
    <script src="{{ asset('assets/js/argon-dashboard-tailwind.min.js') }}"></script>

</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">

    <div class="container min-h-screen flex items-center justify-center">
        <div class="flex flex-wrap w-full">
            <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                <div
                    class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 mb-0 text-center font-bold bg-white border-b-0 rounded-t-2xl">
                        <h5>{{ $title }}</h5>
                    </div>
                    {{ $slot }}

                </div>
            </div>
        </div>

        @livewireScripts
</body>

</html>
