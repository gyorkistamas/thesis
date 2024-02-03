<?php

namespace App\Livewire\Administration;

use Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class CourseListItem extends Component
{
    use WireToast, WithPagination;

    public $course;

    public $newCourseCode;

    public $newCourseDescription;

    public $newCourseLimit;

    public $newCourseTeachers;

    public $newCourseSemester;

    public $currentTab = 'edit';

    public $deleted = false;

    #[On('single-select-term.{course.id}')]
    public function updateSemester($data)
    {
        $this->newCourseSemester = $data;
    }

    #[On('multiple-select-teacher.{course.id}')]
    public function updateTeachers($data)
    {
        $this->newCourseTeachers = $data;
    }

    public function mount($course)
    {
        $this->course = $course;
        $this->newCourseCode = $course->course_id;
        $this->newCourseDescription = $course->description;
        $this->newCourseLimit = $course->course_limit;
        $this->newCourseTeachers = $course->Teachers->pluck('id')->toArray();
        $this->newCourseSemester = $course->Term->id;
    }

    public function editCourse()
    {
        if (Auth::user()->cannot('update', $this->course)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->validate([
            'newCourseCode' => ['required', 'string', 'max:255', Rule::unique('courses', 'course_id')->where('term_id',
                $this->course->term_id)->ignore($this->course->id),
            ],
            'newCourseDescription' => 'nullable|string|max:255',
            'newCourseLimit' => 'required|integer|between:0,200',
            'newCourseSemester' => 'required|exists:terms,id',
        ]);

        $this->course->update([
            'course_id' => $this->newCourseCode,
            'description' => $this->newCourseDescription,
            'course_limit' => $this->newCourseLimit,
            'term_id' => $this->newCourseSemester,
        ]);

        $this->course->Teachers()->sync($this->newCourseTeachers);

        toast()->success(__('general.courseUpdated'), __('general.success'))->push();
    }

    public function render()
    {
        return view('livewire.administration.course-list-item');
    }
}
