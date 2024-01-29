<!doctype html>
<html lang="{{ App::currentLocale()  }}" data-theme="{{Cookie::get('theme') ?? 'dark'}}" style="scroll-padding-top: 5rem; scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', __('general.Attendance'))</title>
    <link rel="icon" type="image/x-icon" href="{{config('presencetracker.favicon')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    @vite('resources/css/themeswitcher.css')
    @vite('resources/js/app.js')
    @vite('resources/css/select2.min.css')
    @vite('resources/js/select2.min.js')
</head>
<body class="font-serif h-full min-h-screen" dir="ltr">
<livewire:toasts />
@yield('content_place')

<!--
<footer class="p-2 bg-base-300 sticky top-[100vh] flex flex-row justify-center sm:justify-end items-center gap-1.5">
    <livewire:languageswitcher></livewire:languageswitcher>
    <livewire:themeswitcher></livewire:themeswitcher>
</footer>
-->
<livewire:simple-notification />
</body>
</html>
