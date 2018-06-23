<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header>
    @include('layouts.default.header')
</header>
<main>
    <section id="app">
        @yield('content')
    </section>
</main>
<div id="loader">
    <loader />
</div>
@include('layouts.default.footer')


@component('layouts.default.bodyscripts')
    @yield('scripts')
@endcomponent
</body>
</html>
