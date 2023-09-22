<!doctype html>
<html lang="{{ App::currentLocale()  }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', __('general.Attendance'))</title>
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    @vite('resources/css/app.css')
    @vite('resources/css/themeswitcher.css')

</head>
<body class="font-serif h-max min-h-screen" data-theme="{{Cookie::get('theme') ?? 'dark'}}">

@yield('content')

<footer class="p-2 bg-neutral sticky top-[100vh] flex flex-row justify-center sm:justify-end items-center gap-1.5">
    <livewire:languageswitcher></livewire:languageswitcher>
    <livewire:themeswitcher></livewire:themeswitcher>
</footer>
</body>
</html>
