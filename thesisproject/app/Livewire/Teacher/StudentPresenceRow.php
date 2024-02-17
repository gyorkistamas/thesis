<?php

namespace App\Livewire\Teacher;

use App\Models\Attendance;
use App\Notifications\AbsenceNotification;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class StudentPresenceRow extends Component
{
    use WireToast;

    public $student;

    public $pivot;

    public $lateMinutes;

    public $isJustified = false;

    public $allAbsents;

    public $notJustifiedAbsents;

    public function ActiveAcceptedJustification()
    {
        $temp = $this->student->Justifications()->whereHas('Acceptances', function ($q) {
            $q->where('user_id', Auth::user()->id);
            $q->where('status', 'accepted');
        })
            ->where('start_date', '<=', $this->pivot->Class->start_time)
            ->where('end_time', '>=', $this->pivot->Class->end_time)
            ->count();

        return $temp > 0;
    }

    public function getNumbersForAbsents()
    {
        $course = $this->pivot->Class->Course;

        $allAbsents = Attendance::whereHas('Class', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })
            ->where('user_id', $this->student->id)
            ->whereIn('attendance', ['missing', 'justified'])
            ->count();

        $notJustified = Attendance::whereHas('Class', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })
            ->where('user_id', $this->student->id)
            ->where('attendance', 'missing')
            ->count();

        $this->allAbsents = $allAbsents;
        $this->notJustifiedAbsents = $notJustified;
    }

    public function mount($student)
    {
        $this->student = $student;
        $this->pivot = $student->pivot;
        $this->isJustified = $this->ActiveAcceptedJustification();
        $this->getNumbersForAbsents();
    }

    #[On('echo:updatePresence.{pivot.id},.App\Events\ClassPresenceChanged')]
    public function presenceUpdated($event)
    {
        $this->pivot->refresh();
        $this->dispatch('refreshChart');
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

        $this->getNumbersForAbsents();
        $this->dispatch('refreshChart');
    }

    public function render()
    {
        return view('livewire.teacher.student-presence-row');
    }
}
