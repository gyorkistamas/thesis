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

    public $class;

    public $lateMinutes;

    public $isJustified = false;

    public $allAbsents;

    public $notJustifiedAbsents;

    public function ActiveAcceptedJustification()
    {
        $temp = $this->student->Justifications
            ->where('start_date', '<=', $this->class->start_time)
            ->where('end_time', '>=', $this->class->end_time)
            ->filter(function ($justification) {
                return $justification->Acceptances->where('status', 'accepted')
                    ->where('user_id', Auth::user()->id)->count() > 0;
            });

        return $temp->count() > 0;
    }

    public function getNumbersForAbsents()
    {
        $allAbsents = Attendance::withWhereHas('Class', function ($query) {
            $query->where('course_id', $this->class->course->id);
        })
            ->where('user_id', $this->student->id)
            ->whereIn('attendance', ['missing', 'justified'])
            ->count();

        $notJustified = Attendance::withWhereHas('Class', function ($query) {
            $query->where('course_id', $this->class->course->id);
        })
            ->where('user_id', $this->student->id)
            ->where('attendance', 'missing')
            ->count();

        $this->allAbsents = $allAbsents;
        $this->notJustifiedAbsents = $notJustified;
    }

    public function mount($student, $cclass)
    {
        $this->pivot = $student->pivot;
        $this->student = $student;
        $this->class = $cclass;
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
            $this->student->notify((new AbsenceNotification($this->student, $this->pivot->Class,
                Auth::user()))->locale($this->student->lang));
        }

        $this->getNumbersForAbsents();
        $this->dispatch('refreshChart');
    }

    public function render()
    {
        return view('livewire.teacher.student-presence-row');
    }
}
