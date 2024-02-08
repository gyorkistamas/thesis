<?php

namespace App\Livewire\Teacher;

use Livewire\Component;

class StudentPresenceRow extends Component
{
    public $student;

    public function mount($student)
    {
        $this->student = $student;
    }

    public function render()
    {
        return view('livewire.teacher.student-presence-row');
    }
}
