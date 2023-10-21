<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class UpdatePassword extends Component
{
    public $currentPassword;

    #[Rule('required|min:8|max:50')]
    public $password;

    public $password_confirmation;

    public User $user;

    public function changePassword()
    {
        if (Auth::user()->id != $this->user->id) {
            $this->dispatch('sendNotif', [
                'title' => __('general.error'), 'message' => __('general.noPermission'),
                'type' => SimpleNotification::TYPE_ALERT, 'timer' => 5,
            ]);

            return;
        }

        if (! Hash::check($this->currentPassword, $this->user->password)) {
            $this->dispatch('sendNotif', [
                'title' => __('general.error'), 'message' => __('auth.password'),
                'type' => SimpleNotification::TYPE_ALERT, 'timer' => 5,
            ]);

            return;
        }

        $this->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                'confirmed',
            ],
        ]);

        $this->user->password = Hash::make($this->password);
        $this->user->save();
        $this->dispatch('sendNotif', [
            'title' => __('general.success'), 'message' => __('auth.passwordChanged'),
            'type' => SimpleNotification::TYPE_SUCCESS, 'timer' => 10,
        ]);
    }

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.update-password');
    }
}
