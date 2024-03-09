<?php

namespace App\Http\Controllers;

class ConfigController extends Controller
{
    public function getCreationSite()
    {
        return view('settings.administration');
    }

    public function getConfig()
    {
        return view('settings.config');
    }
}
