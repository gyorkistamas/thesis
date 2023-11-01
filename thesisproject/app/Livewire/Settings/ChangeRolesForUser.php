<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use function Symfony\Component\Translation\t;

class ChangeRolesForUser extends Component
{
    use WireToast;

    public User $user;

    public $superadmin;

    public $admin;

    public $teacher;

    public $student;

    public function mount(User $user)
    {
        $this->user = $user;
        if ($user->hasRole('superadmin')) {
            $this->superadmin = true;
        }

        if ($user->hasRole('admin')) {
            $this->admin = true;
        }

        if ($user->hasRole('teacher')) {
            $this->teacher = true;
        }

        if ($user->hasRole('student')) {
            $this->student = true;
        }
    }

    #[On('updateRoles.{user.id}')]
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

    public function render()
    {
        return view('livewire.settings.change-roles-for-user');
    }
}
