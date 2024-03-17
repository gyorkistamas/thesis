<?php

namespace App\Livewire\Administration;

use App\Models\Place;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class PlacesList extends Component
{
    use WireToast, WithPagination;

    public $newName;

    public function newPlace()
    {
        if (Auth::user()->cannot('create', Place::class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->validate([
            'newName' => ['required', 'string', 'max:255', 'unique:places,name'],
        ]);

        Place::create([
            'name' => $this->newName,
        ]);

        $this->newName = '';
        toast()->success(__('general.createNewPlace'), __('general.success'))->push();

    }

    public function render()
    {
        $places = Place::paginate(10, pageName: 'placesPage');

        return view('livewire.administration.places-list')->with('places', $places);
    }
}
