<?php

namespace App\Livewire\Student;

use App\Models\Subject;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class MySubjects extends Component
{
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
        $subjects = Subject::withWhereHas('Courses', function ($query) {
            if ($this->semesterSearch != '') {
                $query->where('term_id', $this->semesterSearch);
            }
            $query->whereHas('Students', function ($query) {
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

        return view('livewire.student.my-subjects')->with('subjects', $subjects);
    }
}
