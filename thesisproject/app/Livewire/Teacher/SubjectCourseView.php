<?php

namespace App\Livewire\Teacher;

use App\Models\Subject;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class SubjectCourseView extends Component
{
    use WireToast, WithPagination;

    public $codeSearch;

    public $nameSearch;

    public $semesterSearch;

    #[On('single-select-term.-1')]
    public function updateSemester($data)
    {
        $this->semesterSearch = $data;
    }

    public function render()
    {
        $subjects = Subject::whereHas('Courses', function ($query) {
            if ($this->semesterSearch != -1) {
                $query->where('term_id', $this->semesterSearch);
            }
            $query->whereHas('Teachers', function ($query) {
                $query->where('users.id', Auth::user()->id);
            });
        })
            ->where(function ($query) {
                if ($this->codeSearch != '') {
                    $query->where('id', 'like', '%'.$this->codeSearch.'%');
                }
                if ($this->nameSearch != '') {
                    $query->where('name', 'like', '%'.$this->nameSearch.'%');
                }
            })
            ->paginate(10, pageName: 'subjectPage');

        return view('livewire.teacher.subject-course-view')->with('subjects', $subjects);
    }
}
