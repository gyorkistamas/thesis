<?php

namespace App\Livewire\Teacher;

use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CourseStudents extends Component
{
    use WireToast;

    public $course;

    public $studentsToAdd;

    #[On('multiple-select-students.{course.id}')]
    public function updateStudents($data)
    {
        $this->studentsToAdd = $data;
    }

    public function addStudents()
    {
        if (Auth::user()->cannot('update', $this->course)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->course->Students()->attach($this->studentsToAdd);

        $this->dispatch('multiple-select-students-update.'.$this->course->id,
            alreadySelected: ['alreadySelected' => $this->course->students->pluck('id')->toArray()]);

        toast()->success(__('general.studentsAdded'), __('general.success'))->push();
    }

    public function removeStudent($student_id)
    {
        if (Auth::user()->cannot('update', $this->course)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->course->Students()->detach($student_id);

        $this->dispatch('multiple-select-students-update.'.$this->course->id,
            alreadySelected: ['alreadySelected' => $this->course->students->pluck('id')->toArray()]);

        toast()->success(__('general.studentRemoved'), __('general.success'))->push();
    }

    public function mount($course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.teacher.course-students');
    }
}
