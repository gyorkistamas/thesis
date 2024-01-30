<?php

namespace App\Livewire\Administration;

use Livewire\Component;

class SubjectDropDown extends Component
{
    public $subject;

    public function mount($subject)
    {
        $this->subject = $subject;
    }

    public function render()
    {
        return view('livewire.administration.subject-drop-down');
    }
}
