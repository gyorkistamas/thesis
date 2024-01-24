<?php

namespace App\Http\Controllers;

class ConfigController extends Controller
{
    public function index()
    {
        return view('config.config');
    }

    public function getCreationSite()
    {
        return view("settings.administration");
    }
}
