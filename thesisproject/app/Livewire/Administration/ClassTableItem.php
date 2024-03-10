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
        if (Auth::user()->cannot('update', $this->class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->validate([
            'editStart' => 'required|date|after:'.$this->class->Course->Term->start.'|before:'.$this->class->Course->Term->end,
            'editEnd' => 'required|date|after:editStart|before:'.$this->class->Course->Term->end,
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

        $this->class->StudentsWithPresence()->detach();

        $temp = $this->class;
        $temp->delete();
        $this->class = null;
        $this->deleted = true;

        toast()->success(__('general.classDeleted'), __('general.success'))->push();
    }

    public function mount($class)
    {
        $this->class = $class;
        $this->editStart = $class->start_time->isoFormat('YYYY-MM-DD HH:mm:ss');
        $this->editEnd = $class->end_time->isoFormat('YYYY-MM-DD HH:mm:ss');
        if ($class->Place()->exists()) {
            $this->editPlace = $class->Place->id;
        } else {
            $this->editPlace = null;
        }

        //dd($this);
    }

    public function render()
    {
        return view('livewire.administration.class-table-item');
    }
}
