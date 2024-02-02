<?php

namespace App\Livewire\Administration;

use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class SubjectDropDown extends Component
{
    use WireToast;

    public $subject;

    public $subjectCode;

    public $subjectName;

    public $subjectDescription;

    public $subjectCredit;

    public $subjectManager;

    public $isOpen = false;

    public $deleted = false;

    public $newCourseID;

    public $newCourseDescription;

    public $newCourseLimit;

    public $newCourseTeacher;

    public $newCourseSemester;

    public $filterCoursesBySemester;

    #[On('single-select-term.{subject.id}.filter')]
    public function updatefilterCoursesBySemester($data)
    {
        $this->filterCoursesBySemester = $data;
        $this->dispatch('$refresh');
    }

    #[On('single-select-term.-1')]
    public function updateSemester($data)
    {
        $this->newCourseSemester = $data;
    }

    #[On('multiple-select-teacher.-1')]
    public function updateTeacher($data)
    {
        $this->newCourseTeacher = $data;
    }

    #[On('single-select-teacher.{subject.id}')]
    public function updateManager($data)
    {
        $this->subjectManager = $data;
    }

    public function rules()
    {
        return [
            'subjectCode' => ['required', Rule::unique('subjects', 'id')->ignore($this->subject)],
            'subjectName' => 'required',
            'subjectDescription' => 'string|nullable',
            'subjectCredit' => 'required|numeric|between:1,20',
            'subjectManager' => 'required|exists:users,id',
        ];
    }

    public function updateSubject()
    {
        if (Auth::user()->cannot('update', $this->subject)) {
            toast()->danger(__('general.noPermission', __('general.error')))->push();

            return;
        }

        $this->validate();

        $this->subject->update([
            'id' => $this->subjectCode,
            'name' => $this->subjectName,
            'description' => $this->subjectDescription,
            'credit' => $this->subjectCredit,
            'manager' => $this->subjectManager,
        ]);

        toast()->success(__('general.updateSuccess'), __('general.success'))->push();
    }

    public function deleteSubject()
    {
        if (Auth::user()->cannot('delete', $this->subject)) {
            toast()->danger(__('general.noPermission', __('general.error')))->push();

            return;
        }

        $temp = $this->subject;
        $this->subject = null;
        $temp->delete();
        $this->deleted = true;

        toast()->success(__('general.deleteSuccessful'), __('general.success'))->push();
    }

    public function mount($subject)
    {
        $this->subject = $subject;
        $this->subjectCode = $subject->id;
        $this->subjectName = $subject->name;
        $this->subjectDescription = $subject->description;
        $this->subjectCredit = $subject->credit;
        $this->subjectManager = $subject->Manager->id;
    }

    public function createCourse()
    {
        if (Auth::user()->cannot('create', Course::class)) {
            toast()->danger(__('general.noPermission', __('general.error')))->push();

            return;
        }

        $this->validate([
            'newCourseID' => 'required|string|max:255',
            'newCourseDescription' => 'nullable|string|max:255',
            'newCourseLimit' => 'required|numeric|between:0,500',
            'newCourseSemester' => 'required|exists:terms,id',
        ]);
        // TODO validate teachers

        $course = Course::create([
            'course_id' => $this->newCourseID,
            'description' => $this->newCourseDescription,
            'course_limit' => $this->newCourseLimit,
            'subject_id' => $this->subject->id,
            'term_id' => $this->newCourseSemester,
        ]);

        if($this->newCourseTeacher)
        {
            foreach ($this->newCourseTeacher as $teacher) {
                $user = User::findOrFail($teacher);
                $course->Teachers()->attach($user);
            }
        }

        toast()->success(__('general.courseCreated'), __('general.success'))->push();
    }

    public function getCourses()
    {
        if ($this->filterCoursesBySemester) {
            return $this->subject->CoursesbySemester($this->filterCoursesBySemester)->paginate(10, pageName: 'courses'.$this->subject->id);
        }

        return $this->subject->Courses()->paginate(10, pageName: 'courses'.$this->subject->id);
    }

    public function render()
    {
        return view('livewire.administration.subject-drop-down');
    }
}
