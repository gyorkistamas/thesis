<?php

namespace App\Livewire;

use Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Languageswitcher extends Component
{
    public function setHungarian()
    {
        Cookie::queue('lang', 'hu');
        if (Auth::user()) {
            Auth::user()->lang = 'hu';
            Auth::user()->save();
        }
        $this->js('window.location.reload()');
    }

    public function setEnglish()
    {
        Cookie::queue('lang', 'en');
        if (Auth::user()) {
            Auth::user()->lang = 'en';
            Auth::user()->save();
        }
        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.languageswitcher');
    }
}
