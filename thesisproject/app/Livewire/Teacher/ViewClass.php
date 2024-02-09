<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\On;
use Livewire\Component;

class ViewClass extends Component
{
    public $class;

    public function mount($class)
    {
        $this->class = $class;
    }

    #[On('refreshChart')]
    public function updateChart()
    {
        $data = [
            0 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'present')->count(),
            1 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'justified')->count(),
            2 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'missing')->count(),
            3 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'late')->count(),
            4 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'not_filled')->count(),
        ];
        $this->dispatch('updateChart', data: $data);
    }

    public function render()
    {
        return view('livewire.teacher.view-class');
    }
}
