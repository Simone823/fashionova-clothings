<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TItle -->
    <title>{{ config('app.name', 'Laravel') }} | @yield('metaTitle')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/guest.js') }}" defer></script>
    @stack('javascript')
</head>
<body>

    {{-- loader --}}
    @include('components.guest.loaderPage')

    <div id="app" class="d-none"> 
        {{-- navbar --}}
        @include('components.guest.navbar')

        {{-- main --}}
        <main>
            {{-- flash message --}}
            @include('components.flashMessage')
            
            @yield('content')
        </main>

        {{-- footer --}}
        @include('components.guest.footer')
    </div>

</body>
</html>