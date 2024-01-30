<?php

namespace App\Livewire\DropdownSelect;

use App\Models\User;
use Livewire\Component;

class TeacherSingleSelect extends Component
{
    public $query = '';

    public $data;

    public $selected_items = [];

    public function updatedQuery()
    {
        $this->data = User::whereHas('roles', function ($query) {
            $query->where('role', 'teacher');
        })
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->query.'%')
                    ->orWhere('neptun', 'like', '%'.$this->query.'%');
            })
            ->get()
            ->toArray();
    }

    public function addSelectedItem($user_id)
    {
        if (! empty($this->selected_items)) {
            return;
        }
        $user = User::findOrFail($user_id, ['id', 'name', 'neptun']);

        if (! empty($this->selected_items)) {
            if (! in_array($user['id'], array_column($this->selected_items, 'id'))) {
                $this->selected_items[] = $user;
                $this->query = '';
            }
        } else {
            $this->selected_items[] = $user;
            $this->query = '';
        }

        $this->dispatch('single-select-teacher', data: $user->id);
    }

    public function removeSelectedItem($id)
    {
        foreach ($this->selected_items as $key => $item) {
            if ($item['id'] == $id) {
                unset($this->selected_items[$key]);
                break;
            }
        }
        $this->dispatch('single-select-teacher', data: '');
    }

    public function resetProps()
    {
        $this->reset(['query', 'data']);
    }

    public function render()
    {
        return view('livewire.dropdown-select.teacher-single-select');
    }
}
