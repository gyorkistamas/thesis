<!doctype html>
<html lang="{{ App::currentLocale()  }}" data-theme="{{Cookie::get('theme') ?? 'dark'}}" style="scroll-padding-top: 5rem; scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', __('general.Attendance'))</title>
    <link rel="icon" type="image/x-icon" href="{{config('presencetracker.favicon')}}">
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    @vite('resources/css/app.css')
    @vite('resources/css/themeswitcher.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('calendar-scripts')
    @yield('styles')

    @laravelPWA

</head>
<body class="font-serif h-full min-h-screen" dir="ltr">
<livewire:toasts class="z-[900]"/>

<div class="backdrop-blur-[1.5px] min-h-screen">
    @yield('content_place')
</div>

@yield('scripts')
</body>
</html>
