<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')
    </head>
    <body class="bg-green-400 h-full">
        <div class="grid grid-cols-2 gap-1.5">
            <button class="btn btn-primary">Teszt</button>
            <button class="btn btn-accent">Teszt 2</button>
        </div>
    </body>
</html>
