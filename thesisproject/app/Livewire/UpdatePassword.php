<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class UpdatePassword extends Component
{
    use WireToast;

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

            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        if (! Hash::check($this->currentPassword, $this->user->password)) {
            toast()->warning(__('auth.password'), __('general.error'))->push();

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
        toast()->success(__('auth.passwordChanged'), __('general.success'))->push();
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
