<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @livewireStyles
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" ></script> --}}
</head>

<body class="font-sans antialiased" style="background-color:#F0F2F5; ">
    {{-- <x-jet-banner /> --}}
    @livewire('navigation-menu')

    <!-- Page Heading -->
    {{-- <header class="d-flex py-3 bg-white shadow-sm border-bottom">
            <div class="container">
                {{ $header }}
            </div>
        </header> --}}

    <!-- Page Content -->
    <main class="container ">
        {{ $slot }}
    </main>

    @stack('modals')

    @livewireScripts

    {{-- @stack('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>
