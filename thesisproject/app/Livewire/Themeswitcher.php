<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Themeswitcher extends Component
{
    public function changeTheme()
    {
        if (Cookie::get('theme') == 'light') {
            Cookie::queue('theme', 'dark');
        } else {
            Cookie::queue('theme', 'light');
        }
    }

    public function render()
    {
        return view('livewire.themeswitcher');
    }
}
