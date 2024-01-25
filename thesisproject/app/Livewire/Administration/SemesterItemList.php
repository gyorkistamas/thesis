<?php

namespace App\Livewire\Administration;

use App\Models\Term;
use Auth;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class SemesterItemList extends Component
{
    use WireToast;

    public ?Term $term;

    public $editName;

    public $editStart;

    public $editEnd;

    public $deleted = false;

    public $rules = [
        'editName' => 'required',
        'editStart' => 'required|date',
        'editEnd' => 'required|date|after:editStart',
    ];

    public function edit()
    {
        $this->validate();

        if (Auth::user()->cannot('update', $this->term)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        foreach (Term::all() as $term) {
            if ($term->start <= $this->editStart && $term->end >= $this->editStart && $term->id != $this->term->id) {
                toast()->danger(__('general.overlap'), __('general.error'))->push();

                return;
            }
            if ($term->start <= $this->editEnd && $term->end >= $this->editEnd && $term->id != $this->term->id) {
                toast()->danger(__('general.overlap'), __('general.error'))->push();

                return;
            }
        }

        $this->term->update([
            'name' => $this->editName,
            'start' => $this->editStart,
            'end' => $this->editEnd,
        ]);

        toast()->success(__('general.updateSuccess'), __('general.success'))->push();
    }

    public function delete()
    {
        //TODO check if semester is in use
        if (Auth::user()->cannot('delete', $this->term)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $temp = $this->term;
        $this->term = null;
        $temp->delete();

        $this->deleted = true;

        $this->dispatch('semesterRefresh');

        toast()->success(__('general.deleteSuccessful'), __('general.success'))->push();
    }

    public function mount(Term $term)
    {
        if ($term->exists()) {
            $this->term = $term;
            $this->editName = $term->name;
            $this->editStart = $term->start;
            $this->editEnd = $term->end;
        }
    }

    public function render()
    {
        return view('livewire.administration.semester-item-list');
    }
}
