<?php

namespace App\Livewire\Student;

use Livewire\Attributes\On;
use Livewire\Component;

class CourseComponent extends Component
{
    public $course;

    public $loaded = false;

    #[On('loadCourse.{course.id}')]
    public function load()
    {
        if (! $this->loaded) {
            $this->loaded = true;
        }
    }

    public function mount($course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.student.course-component');
    }
}
