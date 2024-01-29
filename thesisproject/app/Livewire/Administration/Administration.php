<?php

namespace App\Livewire\Administration;

use Livewire\Attributes\Url;
use Livewire\Component;

class Administration extends Component
{

    #[Url]
    public $selectedTab = 'semesters';

    public function render()
    {
        return view('livewire.administration.administration');
    }
}
