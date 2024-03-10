<?php

namespace App\Livewire\Administration;

use App\Models\Place;
use Auth;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class PlaceItemList extends Component
{
    use WireToast;

    public ?Place $place;

    public $editName;

    public $deleted = false;

    public $rules = [
        'editName' => 'required|string|max:255',
    ];

    public function edit()
    {
        $this->validate();

        if (Auth::user()->cannot('update', $this->place)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->place->update([
            'name' => $this->editName,
        ]);

        toast()->success(__('general.updateSuccess'), __('general.success'))->push();
    }

    public function delete()
    {
        if (Auth::user()->cannot('delete', $this->place)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $temp = $this->place;
        $this->place = null;
        $temp->delete();

        $this->deleted = true;

        //$this->dispatch('semesterRefresh');

        toast()->success(__('general.deleteSuccessful'), __('general.success'))->push();
    }

    public function mount(Place $place)
    {
        if ($place->exists()) {
            $this->place = $place;
            $this->editName = $place->name;
        }
    }

    public function render()
    {
        return view('livewire.administration.place-item-list');
    }
}
