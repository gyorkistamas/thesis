<?php

namespace App\Livewire\Teacher;

use Livewire\Component;

class ViewClass extends Component
{

    public $class;

    public function mount($class)
    {
        $this->class = $class;
    }

    public function render()
    {
        return view('livewire.teacher.view-class');
    }
}
