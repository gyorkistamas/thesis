<?php

namespace App\Livewire\Teacher;

use App\Notifications\AbsenceNotification;
use Auth;
use Livewire\Attributes\On;
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

    #[On('echo:presenceUpdated.{pivot.id},.Illuminate\Notifications\Events\ClassPresenceChanged')]
    public function presenceUpdated($event)
    {
        dd($event);
    }

    public function setLateMinutes()
    {
        // TODO igazolt óra ellenőrzése és email küldés
        $this->pivot->attendance = 'late';
        $this->pivot->late_minutes = $this->lateMinutes;
        $this->pivot->save();
        $this->dispatch('closeLateDropdown', data: $this->student->id);
        $this->dispatch('refreshChart');
    }

    public function setAttendance($status)
    {
        // TODO igazolt óra ellenőrzése és email küldés
        $this->pivot->attendance = $status;
        $this->pivot->late_minutes = 0;
        $this->pivot->save();

        if ($status === 'missing') {
            $this->student->notify(new AbsenceNotification($this->student, $this->pivot->Class, Auth::user()));
        }

        $this->dispatch('refreshChart');
    }

    public function render()
    {
        return view('livewire.teacher.student-presence-row');
    }
}
