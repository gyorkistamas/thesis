<?php

return [
    'sitename' => env('SITENAME', 'Presence Tracker'),
    'favicon' => '/favicon.ico',
    'logo' => env('LOGO', 'def_logo.png'),
    'enableRegister' => env('ALLOWREGISTER', true),
    'maxNotJustifiedAbsences' => env('MAX_NOT_JUSTIFIED_ABSENCES', 3),
    'allowChangeNeptunCode' => env('ALLOW_CHANGE_NEPTUN_CODE', false),
    'requireNeptunCode' => env('REQUIRE_NEPTUN_CODE', false),
];
