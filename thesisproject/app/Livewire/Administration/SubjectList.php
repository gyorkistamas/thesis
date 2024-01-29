<?php

namespace App\Livewire\Administration;

use Livewire\Component;

class SubjectList extends Component
{
    public function render()
    {
        $this->dispatch('setupSelect2');

        return view('livewire.administration.subject-list');
    }
}
