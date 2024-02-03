<?php

namespace App\Livewire\DropdownSelect;

use App\Models\Place;
use Livewire\Component;

class SinglePlaceSelect extends Component
{
    public $query = '';

    public $data;

    public $selected_items = [];

    public $classId;

    public function updatedQuery()
    {
        $this->data = Place::where('name', 'like', '%'.$this->query.'%')
            ->get()
            ->toArray();
    }

    public function addSelectedItem($place_id)
    {
        if (! empty($this->selected_items)) {
            return;
        }
        $place = Place::findOrFail($place_id, ['id', 'name']);

        if (! empty($this->selected_items)) {
            if (! in_array($place['id'], array_column($this->selected_items, 'id'))) {
                $this->selected_items[] = $place;
                $this->query = '';
            }
        } else {
            $this->selected_items[] = $place;
            $this->query = '';
        }

        $this->dispatch('single-select-place.'.$this->classId, data: $place->id);
    }

    public function removeSelectedItem($id)
    {
        foreach ($this->selected_items as $key => $item) {
            if ($item['id'] == $id) {
                unset($this->selected_items[$key]);
                break;
            }
        }
        $this->dispatch('single-select-place.'.$this->classId, data: '');
    }

    public function resetProps()
    {
        $this->reset(['query', 'data']);
    }

    public function mount($selectedId, $classId)
    {
        $this->classId = $classId;

        if ($selectedId != null) {
            $this->selected_items[] = Place::findOrFail($selectedId, ['id', 'name']);
        }
    }

    public function render()
    {
        return view('livewire.dropdown-select.single-place-select');
    }
}
