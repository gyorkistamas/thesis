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
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    @vite('resources/css/app.css')
    @vite('resources/css/themeswitcher.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/hu.js"></script>
    @yield('styles')
</head>
<body class="font-serif h-full min-h-screen" dir="ltr">
<livewire:toasts class="z-[900]"/>
@yield('content_place')

@yield('scripts')
<script src="{{ asset('/sw.js') }}"></script>
<script data-navigate-once>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>
</body>
</html>
