<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class UserRow extends Component
{
    use WireToast;

    public $user;

    public $deleted = false;

    public function mount($user)
    {
        $this->user = $user;
    }

    #[On('updateUser.{user.id}')]
    public function update()
    {
        $this->user->refresh();
    }

    public function deleteUser()
    {
        //TODO deletion of user if constraint
        if (! Auth::user()->hasRole('superadmin')) {
            toast()->danger(__('general.noPermission'), __('general.noPermission'))->push();

            return;
        }
        $temp = $this->user;
        $this->user = null;
        $temp->delete();
        $this->deleted = true;
        toast()->success(__('general.deleteSuccessful'), __('general.success'))->push();
    }

    public function render()
    {
        return view('livewire.settings.user-row');
    }
}
