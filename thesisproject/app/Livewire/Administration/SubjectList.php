<?php

namespace App\Livewire\Administration;

use App\Models\Subject;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class SubjectList extends Component
{
    use WireToast, WithPagination;

    public $subjectCode;

    public $subjectName;

    public $subjectDescription;

    public $subjectCredit;

    public $subjectManager;

    public $idSearch;

    public $nameSearch;

    public $created = 1;

    public function rules()
    {
        return [
            'subjectCode' => 'required|unique:subjects,id',
            'subjectName' => 'required',
            'subjectDescription' => 'required',
            'subjectCredit' => 'required|numeric|between:1,20',
            'subjectManager' => 'required|exists:users,id',
        ];
    }

    public function resetSearch()
    {
        $this->created += 1;
        $this->idSearch = '';
        $this->nameSearch = '';
    }

    #[On('single-select-teacher')]
    public function setManager($data)
    {
        $this->subjectManager = $data;
    }

    public function createSubject()
    {
        if (Auth::user()->cannot('create', Subject::class)) {
            toast()->danger(__('general.noPermission', __('general.error')))->push();

            return;
        }

        $this->validate();

        $subject = new Subject();
        $subject->id = $this->subjectCode;
        $subject->name = $this->subjectName;
        $subject->description = $this->subjectDescription;
        $subject->credit = $this->subjectCredit;
        $subject->manager = $this->subjectManager;
        $subject->save();
        //TODO close modal maybe

        $this->created += 1;
        toast()->success(__('general.subjectCreated'), __('general.success'))->push();
    }

    public function render()
    {
        $subjects = Subject::where(function ($query) {
            if ($this->idSearch != '') {
                $query->where('id', 'like', '%'.$this->idSearch.'%');
            }
            if ($this->nameSearch != '') {
                $query->where('name', 'like', '%'.$this->nameSearch.'%');
            }
        })
            ->paginate(10, pageName: 'subjectsPage');

        return view('livewire.administration.subject-list')->with('subjects', $subjects);
    }
}
