<!doctype html>
<html lang="{{ App::currentLocale()  }}" data-theme="{{Cookie::get('theme') ?? 'dark'}}" style="scroll-padding-top: 5rem; scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', __('general.Attendance'))</title>
    <link rel="icon" type="image/x-icon" href="{{config('presencetracker.favicon')}}">
    @vite('resources/css/app.css')
    @vite('resources/css/themeswitcher.css')
    @vite('resources/js/app.js')
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
