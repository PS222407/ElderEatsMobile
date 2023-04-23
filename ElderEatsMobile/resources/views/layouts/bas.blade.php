<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ElderEats')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body class="min-h-screen">
<style>
    body::after {
        content: "";
        position: absolute;
        background-image: url('{{ asset('Images/ee_dark.png') }}');
        background-repeat: no-repeat;
        background-position: bottom left;
        background-size: 250px;
        left: 30px;
        bottom: 40px;
        width: 250px;
        height: 250px;
        opacity: 0.2;
        z-index: -1;
        transform: rotate(15deg);
    }
</style>

@include('layouts.nav')
@yield('content')
</body>

</html>
