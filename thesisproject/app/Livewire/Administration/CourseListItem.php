<?php

namespace App\Livewire\Administration;

use App\Models\CourseClass;
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

    public $newClassStart;

    public $newClassEnd;

    public $newClassPlace;

    public $repeatUntilEndOfTerm = false;

    public $newStudents;

    #[On('multiple-select-students.{course.id}')]
    public function studentsToAdd($data)
    {
        $this->newStudents = $data;
    }

    #[On('single-select-place.-1')]
    public function updateNewClassPlace($data)
    {
        $this->newClassPlace = $data;
    }

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
            'newCourseCode' => [
                'required', 'string', 'max:255', Rule::unique('courses', 'course_id')->where('term_id',
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

    public function newClass()
    {
        if (Auth::user()->cannot('create', CourseClass::class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->validate([
            'newClassStart' => 'required|date',
            'newClassEnd' => 'required|date|after:newClassStart',
            'newClassPlace' => 'required|exists:places,id',
        ]);

        $this->course->Classes()->create([
            'start_time' => $this->newClassStart,
            'end_time' => $this->newClassEnd,
            'place_id' => $this->newClassPlace,
        ]);
        // TODO check for students class status and update it
        // TODO implement repeat until end of term
        toast()->success(__('general.classCreated'), __('general.success'))->push();
    }

    public function deleteCourse()
    {
        if (Auth::user()->cannot('delete', $this->course)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $temp = $this->course;
        $this->course = null;
        $temp->delete();
        $this->deleted = true;

        toast()->success(__('general.courseDelete'), __('general.success'))->push();
    }

    public function addStudents()
    {
        if (Auth::user()->cannot('update', $this->course)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->course->Students()->syncWithoutDetaching($this->newStudents);

        // TODO add student status to each class

        $this->dispatch('multiple-select-students-update.'.$this->course->id, ['alreadySelected' => $this->course->Students->pluck('id')->toArray()]);
        toast()->success(__('general.studentsAdded'), __('general.success'))->push();
    }

    public function removeStudent($id)
    {
        if (Auth::user()->cannot('update', $this->course)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->course->Students()->detach($id);

        // TODO remove student status from each class

        $this->dispatch('multiple-select-students-update.'.$this->course->id, ['alreadySelected' => $this->course->Students->pluck('id')->toArray()]);
        toast()->success(__('general.studentRemoved'), __('general.success'))->push();
    }

    public function render()
    {
        return view('livewire.administration.course-list-item');
    }
}
