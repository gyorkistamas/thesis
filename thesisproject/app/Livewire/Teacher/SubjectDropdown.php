<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\On;
use Livewire\Component;

class SubjectDropdown extends Component
{
    public $subject;

    public $semesterSearch;

    public $isOpen = false;

    public $loadedCourse = [];

    public function mount($subject, $semesterSearch)
    {
        $this->subject = $subject;
        $this->semesterSearch = $semesterSearch;
    }

    #[On('courseOpened')]
    public function setLoadedCourse($courseId)
    {
        if (! in_array($courseId, $this->loadedCourse)) {
            $this->loadedCourse[] = $courseId;
        }
    }

    public function render()
    {
        return view('livewire.teacher.subject-dropdown');
    }
}
