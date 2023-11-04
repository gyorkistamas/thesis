<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class DeleteUser extends Component
{
    use WireToast;

    public $user;

    #[On('changeSelectedUser')]
    public function updateUser($id)
    {
        if ($this->user && $id == $this->user->id) {
            return;
        }
        try {
            $this->user = User::find($id);
        } catch (\Exception $e) {

        }

    }

    // TODO törlés után probléma van
    public function deleteUser()
    {
        if (! Auth::user()->hasRole('superadmin')) {
            toast()->danger(__('general.noPermission'), __('general.noPermission'))->push();

            return;
        }
        $this->user->delete();
        $this->user = Auth::user();
        toast()->success(__('general.deleteSuccessful'), __('general.success'))->push();
        $this->dispatch('resetUserList');
    }

    public function render()
    {
        return view('livewire.settings.delete-user');
    }
}
