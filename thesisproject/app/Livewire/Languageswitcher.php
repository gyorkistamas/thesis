<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Languageswitcher extends Component
{

    public function setHungarian()
    {
        Cookie::queue('lang', 'hu');
        $this->js('window.location.reload()');
    }

    public function setEnglish()
    {
        Cookie::queue('lang', 'en');
        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.languageswitcher');
    }
}
