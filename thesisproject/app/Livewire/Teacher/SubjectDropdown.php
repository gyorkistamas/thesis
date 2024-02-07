<?php

namespace App\Livewire\Teacher;

use Livewire\Component;

class SubjectDropdown extends Component
{
    public $subject;
    public $semesterSearch;

    public function mount($subject, $semesterSearch)
    {
        $this->subject = $subject;
        $this->semesterSearch = $semesterSearch;
    }

    public function render()
    {
        return view('livewire.teacher.subject-dropdown');
    }
}
