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
            'newClassStart' => 'required|date|after:'.$this->course->Term->start.'|before:'.$this->course->Term->end,
            'newClassEnd' => 'required|date|after:newClassStart|before:'.$this->course->Term->end,
            'newClassPlace' => 'required|exists:places,id',
        ]);

        if ($this->repeatUntilEndOfTerm) {
            while ($this->newClassEnd < $this->course->Term->end) {

                if ($this->OverlapsClass()) {
                    toast()->danger(__('general.classOverlap'), __('general.error'))->push();
                    $this->NextClass();
                    break;
                }

                $this->course->Classes()->create([
                    'start_time' => $this->newClassStart,
                    'end_time' => $this->newClassEnd,
                    'place_id' => $this->newClassPlace,
                ]);
                $this->NextClass();
            }
        } else {
            if ($this->OverlapsClass()) {
                toast()->danger(__('general.classOverlap'), __('general.error'))->push();

                return;
            }
            $this->course->Classes()->create([
                'start_time' => $this->newClassStart,
                'end_time' => $this->newClassEnd,
                'place_id' => $this->newClassPlace,
            ]);

        }

        foreach ($this->course->Classes as $class) {
            $class->StudentsWithPresence()->sync($this->course->Students->pluck('id')->toArray());
        }

        toast()->success(__('general.classCreated'), __('general.success'))->push();
    }

    private function OverlapsClass()
    {
        $overlaps = $this->course->Classes()
            ->where(function ($query) {
                $query->where('start_time', '<=', $this->newClassStart)
                    ->where('end_time', '>=', $this->newClassStart);
            })
            ->orWhere(function ($query) {
                $query->where('end_time', '>=', $this->newClassStart)
                    ->where('end_time', '<=', $this->newClassEnd);
            })
            ->orWhere(function ($query) {
                $query->where('start_time', '>=', $this->newClassStart)
                    ->where('start_time', '<=', $this->newClassEnd);
            })
            ->count();

        return $overlaps > 0;
    }

    public function NextClass()
    {
        $this->newClassStart = date('Y-m-d H:i:s', strtotime($this->newClassStart.' +1 week'));
        $this->newClassEnd = date('Y-m-d H:i:s', strtotime($this->newClassEnd.' +1 week'));
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

        if ($this->course->course_limit < $this->course->Students->count() + count($this->newStudents)) {
            toast()->danger(__('general.courseLimitExceeded'), __('general.error'))->push();

            return;
        }

        $this->course->Students()->attach($this->newStudents);

        $this->course->load('Students');

        //dd($this->course->Students);

        foreach ($this->course->Classes as $class) {
            $class->StudentsWithPresence()->sync($this->course->Students->pluck('id')->toArray());
        }

        $this->course->refresh();

        $this->dispatch('multiple-select-students-update.'.$this->course->id,
            ['alreadySelected' => $this->course->Students->pluck('id')->toArray()]);
        toast()->success(__('general.studentsAdded'), __('general.success'))->push();
    }

    public function removeStudent($id)
    {
        if (Auth::user()->cannot('update', $this->course)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->course->Students()->detach($id);

        foreach ($this->course->Classes as $class) {
            $class->StudentsWithPresence()->sync($this->course->Students->pluck('id')->toArray());
        }

        $this->dispatch('multiple-select-students-update.'.$this->course->id,
            ['alreadySelected' => $this->course->Students->pluck('id')->toArray()]);
        toast()->success(__('general.studentRemoved'), __('general.success'))->push();
    }

    public function render()
    {
        return view('livewire.administration.course-list-item');
    }
}
