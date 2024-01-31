<?php

namespace App\Livewire\Administration;

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

    public function render()
    {
        return view('livewire.administration.subject-drop-down');
    }
}
