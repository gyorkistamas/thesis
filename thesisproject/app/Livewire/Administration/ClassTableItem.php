<?php

namespace App\Livewire\Administration;

use Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ClassTableItem extends Component
{
    use WireToast;

    public $class;

    public $editStart;

    public $editEnd;

    public $editPlace;

    #[On('single-select-place.{class.id}')]
    public function updatePlace($data)
    {
        $this->editPlace = $data;
    }

    public $deleted = false;

    public function editClass()
    {
        if (Auth::user()->cannot('edit', $this->class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();
            return;
        }

        // TODO check in semester
        $this->validate([
            'editStart' => 'required|date',
            'editEnd' => 'required|date|after:editStart',
            'editPlace' => 'required|exists:places,id',
        ]);

        $this->class->update([
            'start_time' => $this->editStart,
            'end_time' => $this->editEnd,
            'place_id' => $this->editPlace,
        ]);

        toast()->success(__('general.classEdited'), __('general.success'))->push();
    }

    public function deleteClass()
    {
        if (Auth::user()->cannot('delete', $this->class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();
            return;
        }

        // TODO delete student records for this class

        $temp = $this->class;
        $this->class = null;
        $temp->delete();
        $this->deleted = true;

        toast()->success(__('general.classDeleted'), __('general.success'))->push();
    }

    public function mount($class)
    {
        $this->class = $class;
        $this->editStart = $class->start_time;
        $this->editEnd = $class->end_time;
        $this->editPlace = $class->Place->id;
    }

    public function render()
    {
        return view('livewire.administration.class-table-item');
    }
}
