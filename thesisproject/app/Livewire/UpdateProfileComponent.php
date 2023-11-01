<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class UpdateProfileComponent extends Component
{
    use WireToast;

    public $id;

    #[Rule('string|max:6')]
    public $neptun;

    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('required|email|max:255')]
    public $email;

    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->fill($user->only(['neptun', 'name', 'email']));
    }

    public function updateUser()
    {
        $this->validate([
            'neptun' => ['string', 'max:6', \Illuminate\Validation\Rule::unique('users')->ignore($this->user->id)],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($this->user->id),
            ],
        ]);

        if (Auth::user()->id == $this->user->id || Auth::user()->hasRole(['superadmin', 'admin'])) {
            $this->user->forceFill([
                'neptun' => Str::upper($this->neptun),
                'name' => $this->name,
                'email' => $this->email,
            ])->save();
            toast()->success(__('general.updateSuccess'), __('general.success'))->push();
            return;
        }
        toast()->danger(__('general.noPermission'), __('general.error'))->push();
    }

    public function render(
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application {
        return view('livewire.update-profile-component');
    }
}
