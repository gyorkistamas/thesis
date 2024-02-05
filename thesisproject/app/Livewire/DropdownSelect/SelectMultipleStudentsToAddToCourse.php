<?php

namespace App\Livewire\DropdownSelect;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class SelectMultipleStudentsToAddToCourse extends Component
{
    public $query = '';

    public $data;

    public $selected_items = [];

    public $courseId;

    public $alreadySelectedStudents;

    #[On('multiple-select-students-update.{courseId}')]
    public function updateSelectionAndClearQuery($alreadySelected)
    {
        $this->selected_items = [];
        $this->alreadySelectedStudents = $alreadySelected['alreadySelected'];
    }

    public function updatedQuery()
    {
        $this->data = User::whereHas('roles', function ($query) {
            $query->where('role', 'student');
        })
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->query.'%')
                    ->orWhere('neptun', 'like', '%'.$this->query.'%');
            })
            ->whereNotIn('id', $this->alreadySelectedStudents)
            ->get()
            ->toArray();
    }

    public function addSelectedItem($user_id)
    {
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

        $this->dispatch('multiple-select-students.'.$this->courseId, data: array_column($this->selected_items, 'id'));
    }

    public function removeSelectedItem($id)
    {
        foreach ($this->selected_items as $key => $item) {
            if ($item['id'] == $id) {
                unset($this->selected_items[$key]);
                break;
            }
        }
        $this->dispatch('multiple-select-students.'.$this->courseId, data: array_column($this->selected_items, 'id'));
    }

    public function resetProps()
    {
        $this->reset(['query', 'data']);
    }

    public function mount($courseId, $selectedStudents)
    {
        $this->courseId = $courseId;
        $this->alreadySelectedStudents = $selectedStudents;
    }

    public function render()
    {
        return view('livewire.dropdown-select.select-multiple-students-to-add-to-course');
    }
}
