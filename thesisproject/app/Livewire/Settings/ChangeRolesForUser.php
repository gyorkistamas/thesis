<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ChangeRolesForUser extends Component
{
    use WireToast;

    public User $user;

    public $superadmin;

    public $admin;

    public $teacher;

    public $student;

    public function mount()
    {
        $this->user = \Auth::user();
        $this->updateRoles();
    }

    #[On('updateRoles')]
    public function update()
    {
        $this->user->roles()->delete();

        if ($this->superadmin) {
            $this->user->roles()->updateOrCreate(['role' => 'superadmin']);
        }
        if ($this->admin) {
            $this->user->roles()->updateOrCreate(['role' => 'admin']);
        }
        if ($this->teacher) {
            $this->user->roles()->updateOrCreate(['role' => 'teacher']);
        }
        if ($this->student) {
            $this->user->roles()->updateOrCreate(['role' => 'student']);
        }

        toast()->success(__('general.changeroleSuccess'), __('general.success'))->push();
        $this->dispatch('redrawUserList');

    }

    #[On('changeSelectedUser')]
    public function selectUser($id)
    {
        if ($id == $this->user->id) {
            return;
        }
        $this->user = User::find($id);
        $this->updateRoles();
    }

    public function updateRoles()
    {
        if ($this->user->hasRole('superadmin')) {
            $this->superadmin = true;
        } else {
            $this->superadmin = false;
        }

        if ($this->user->hasRole('admin')) {
            $this->admin = true;
        } else {
            $this->admin = false;
        }

        if ($this->user->hasRole('teacher')) {
            $this->teacher = true;
        } else {
            $this->teacher = false;
        }

        if ($this->user->hasRole('student')) {
            $this->student = true;
        } else {
            $this->student = false;
        }
    }

    public function render()
    {
        return view('livewire.settings.change-roles-for-user');
    }
}
