<?php

namespace App\Livewire\Teacher;

use Asantibanez\LivewireCharts\Models\PieChartModel;
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
            1 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'absent')->count(),
            2 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'late')->count(),
            3 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'not_filled')->count(),
        ];
        $this->dispatch('updateChart', data: $data);
    }

    public function render()
    {
        $piechart = (new PieChartModel())
            ->setTitle(__('teacher.presence'))
            ->addSlice(__('teacher.present'),
                $this->class->StudentsWithPresence()->wherePivot('attendance', 'present')->count(), '#4CAF50')
            ->addSlice(__('teacher.absent'),
                $this->class->StudentsWithPresence()->wherePivot('attendance', 'present')->count(), '#F44336')
            ->addSlice(__('teacher.late'),
                $this->class->StudentsWithPresence()->wherePivot('attendance', 'late')->count(), '#FFC107')
            ->addSlice(__('teacher.notFilled'),
                $this->class->StudentsWithPresence()->wherePivot('attendance', 'not_filled')->count(), '#9E9E9E')
            ->setThemePalette('palette3');

        return view('livewire.teacher.view-class')->with('piechart', $piechart);
    }
}
