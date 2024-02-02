<?php

namespace App\Livewire\DropdownSelect;

use App\Models\Term;
use Livewire\Component;

class SelectSingleSemester extends Component
{
    public $query = '';

    public $data;

    public $selected_items = [];

    public $courseId;

    public function updatedQuery()
    {
        $this->data = Term::where('name', 'like', '%'.$this->query.'%')
            ->orderBy('start', 'desc')
            ->get()
            ->toArray();
    }

    public function addSelectedItem($term_id)
    {
        if (! empty($this->selected_items)) {
            return;
        }
        $term = Term::findOrFail($term_id, ['id', 'name']);

        if (! empty($this->selected_items)) {
            if (! in_array($term['id'], array_column($this->selected_items, 'id'))) {
                $this->selected_items[] = $term;
                $this->query = '';
            }
        } else {
            $this->selected_items[] = $term;
            $this->query = '';
        }

        $this->dispatch('single-select-term.'.$this->courseId, data: $term->id);
    }

    public function removeSelectedItem($id)
    {
        foreach ($this->selected_items as $key => $item) {
            if ($item['id'] == $id) {
                unset($this->selected_items[$key]);
                break;
            }
        }
        $this->dispatch('single-select-term.'.$this->courseId, data: '');
    }

    public function resetProps()
    {
        $this->reset(['query', 'data']);
    }

    public function mount($selectedId, $courseId, $autoSelect = false)
    {
        $this->courseId = $courseId;

        if ($autoSelect) {
            foreach (Term::all() as $term) {
                if ($term->active()) {
                    $selectedId = $term->id;
                    $this->dispatch('single-select-term.'.$this->courseId, data: $term->id);
                    break;
                }
            }
        }

        if ($selectedId != null) {
            $this->selected_items[] = Term::findOrFail($selectedId, ['id', 'name']);
        }
    }

    public function render()
    {
        return view('livewire.dropdown-select.select-single-semester');
    }
}
