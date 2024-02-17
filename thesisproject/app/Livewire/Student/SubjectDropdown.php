<?php

namespace App\Livewire\Student;

use Livewire\Component;

class SubjectDropdown extends Component
{
    public $subject;

    public $semesterSearch;

    public $isOpen = false;

    public function mount($subject, $semesterSearch)
    {
        $this->subject = $subject;
        $this->semesterSearch = $semesterSearch;
    }

    public function render()
    {
        return view('livewire.student.subject-dropdown');
    }
}
