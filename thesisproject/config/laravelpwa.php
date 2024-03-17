<?php

return [
    'name' => config('presencetracker.sitename', 'Presence Tracker'),
    'manifest' => [
        'name' => config('presencetracker.sitename', 'Presence Tracker'),
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
            '640x1136' => '/images/icons/splash-640x1136.png',
            '750x1334' => '/images/icons/splash-750x1334.png',
            '828x1792' => '/images/icons/splash-828x1792.png',
            '1125x2436' => '/images/icons/splash-1125x2436.png',
            '1242x2208' => '/images/icons/splash-1242x2208.png',
            '1242x2688' => '/images/icons/splash-1242x2688.png',
            '1536x2048' => '/images/icons/splash-1536x2048.png',
            '1668x2224' => '/images/icons/splash-1668x2224.png',
            '1668x2388' => '/images/icons/splash-1668x2388.png',
            '2048x2732' => '/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    'src' => '/images/icons/icon-72x72.png',
                    'purpose' => 'any',
                ],
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2',
            ],
        ],
        'custom' => [],
    ],
];
