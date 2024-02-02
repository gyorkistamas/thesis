<?php

namespace App\Livewire\Administration;

use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class CourseListItem extends Component
{
    use WireToast, WithPagination;

    public $course;

    public $deleted = false;

    public function mount($course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.administration.course-list-item');
    }
}
