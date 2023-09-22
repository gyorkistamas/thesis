<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class Languageswitcher extends Component
{

    public function changeLanguage($language) {
        App::setLocale($language);
    }

    public function setHungarian()
    {
        App::setLocale('hun');
    }

    public function setEnglish()
    {
        App::setLocale('en');
    }

    public function render()
    {
        return view('livewire.languageswitcher');
    }
}
