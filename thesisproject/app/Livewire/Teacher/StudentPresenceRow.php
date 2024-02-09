<?php

namespace App\Livewire\Teacher;

use Livewire\Component;

class StudentPresenceRow extends Component
{
    public $student;

    public $pivot;

    public $lateMinutes;

    public function mount($student)
    {
        $this->student = $student;
        $this->pivot = $student->pivot;
    }

    public function setLateMinutes()
    {
        // TODO igazolt óra ellenőrzése és email küldés
        $this->pivot->attendance = 'late';
        $this->pivot->late_minutes = $this->lateMinutes;
        $this->pivot->save();
        $this->dispatch('closeLateDropdown', data: $this->student->id);
    }

    public function setAttendance($status)
    {
        // TODO igazolt óra ellenőrzése és email küldés
        $this->pivot->attendance = $status;
        $this->pivot->late_minutes = 0;
        $this->pivot->save();
    }

    public function render()
    {
        return view('livewire.teacher.student-presence-row');
    }
}
