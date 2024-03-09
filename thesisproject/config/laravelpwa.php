<?php

return [
    'name' => env('SITENAME', 'Presence Tracker'),
    'manifest' => [
        'name' => env('SITENAME', 'Presence Tracker'),
        'short_name' => 'Presence Tracker',
        'start_url' => '/',
        'background_color' => '#1e232a',
        'theme_color' => '#407a5d',
        'display' => 'fullscreen',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            '512x512' => [
                'path' => '/rsz_def_logo.png',
                'purpose' => 'any',
            ],
        ],
        'splash' => [
            
        ],
        'shortcuts' => [

        ],
        'custom' => [],
    ],
];
