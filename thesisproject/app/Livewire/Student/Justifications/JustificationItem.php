<?php

namespace App\Livewire\Student\Justifications;

use App\Models\Subject;
use Livewire\Component;

class JustificationItem extends Component
{
    public $justification;

    public $isOpened = false;

    public function mount($justification)
    {
        $this->justification = $justification;
    }

    public function getAffectedClasses()
    {
        return Subject::whereHas('Courses', function ($query) {
            $query->whereHas('Students', function ($query) {
                $query->where('users.id', $this->justification->user_id);
            });
            $query->whereHas('Classes', function ($query) {
                $query->where('start_time', '>=', $this->justification->start_date);
                $query->where('end_time', '<=', $this->justification->end_time);
            });
        })->get();
    }

    public function render()
    {
        return view('livewire.student.justifications.justification-item');
    }
}
