<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ListUsers extends Component
{
    use WireToast, WithPagination;

    public $search;

    #[On('redrawUserList')]
    public function redraw()
    {
        $this->reset();
    }

    #[On('resetUserList')]
    public function searchUsers()
    {
        $this->resetPage();
    }

    public function updateRoles($id)
    {
        $this->dispatch('updateRoles.'.$id);
        $this->reset();
    }

    public $superadmin = false;

    public $admin = false;

    public $teacher = false;

    public $student = false;

    public function render()
    {
        $roles = [];

        if ($this->superadmin) {
            $roles[] = 'superadmin';
        }
        if ($this->admin) {
            $roles[] = 'admin';
        }
        if ($this->teacher) {
            $roles[] = 'teacher';
        }
        if ($this->student) {
            $roles[] = 'student';
        }

        // TODO create fallback user
        $users = User::with('roles')->whereHas('roles', function ($query) use ($roles) {
            if (count($roles) != 0) {
                $query->whereIn('role', $roles);
            }
        }, '>=', count($roles) > 0 ? 1 : 0)
            ->where(function ($query) {
                $query->where([
                    ['id', '!=', \Auth::user()->id],
                    ['neptun', 'like', '%'.$this->search.'%'],
                ])
                    ->orWhere([
                        ['id', '!=', \Auth::user()->id],
                        ['name', 'like', '%'.$this->search.'%'],
                    ]);
            })
            ->paginate(10);

        return view('livewire.settings.list-users', [
            'users' => $users,
        ]);
    }
}
