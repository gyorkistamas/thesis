<?php

namespace App\Livewire\Teacher;

use App\Models\Attendance;
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

        foreach ($this->course->Classes as $class) {
            $class->StudentsWithPresence()->sync($this->course->Students->pluck('id')->toArray());
        }

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

        foreach ($this->course->Classes as $class) {
            $class->StudentsWithPresence()->sync($this->course->Students->pluck('id')->toArray());
        }

        $this->dispatch('multiple-select-students-update.'.$this->course->id,
            alreadySelected: ['alreadySelected' => $this->course->students->pluck('id')->toArray()]);

        toast()->success(__('general.studentRemoved'), __('general.success'))->push();
    }

    public function getMissingCount($student)
    {
        return Attendance::withWhereHas('Class', function ($query) {
            $query->where('course_id', $this->course->id);
        })
            ->where('user_id', $student->id)
            ->whereIn('attendance', ['missing', 'justified'])
            ->count();
    }

    public function getNotJustified($student)
    {
        return Attendance::withWhereHas('Class', function ($query) {
            $query->where('course_id', $this->course->id);
        })
            ->where('user_id', $student->id)
            ->where('attendance', 'missing')
            ->count();
    }

    public function getLateMinutes($student)
    {
        return Attendance::withWhereHas('Class', function ($query) {
            $query->where('course_id', $this->course->id);
        })
            ->where('user_id', $student->id)
            ->where('attendance', 'late')
            ->sum('late_minutes');
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
