<?php

namespace App\Livewire\Administration;

use Livewire\Attributes\On;
use Livewire\Component;

class ClassTableItem extends Component
{
    public $class;

    public $editStart;

    public $editEnd;

    public $editPlace;

    #[On('single-select-place.{class.id}')]
    public function updatePlace($data)
    {
        $this->editPlace = $data;
    }

    public $deleted = false;

    public function mount($class)
    {
        $this->class = $class;
        $this->editStart = $class->start_time;
        $this->editEnd = $class->end_time;
        $this->editPlace = $class->Place->id;
    }

    public function render()
    {
        return view('livewire.administration.class-table-item');
    }
}
