<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class UpdateProfileComponent extends Component
{
    use WireToast, WithFileUploads;

    public $id;

    #[Rule('string|max:6')]
    public $neptun;

    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('required|email|max:255')]
    public $email;

    #[Validate('image|max:1024|nullable')]
    public $picture;

    public User $user;

    public function mount($user): void
    {
        if ($user) {
            $this->user = $user;
        } else {
            $this->user = Auth::user();
        }
        $this->fill($this->user->only(['neptun', 'name', 'email']));
    }

    public function savePicture()
    {
        if (Auth::user()->cannot('update', $this->user)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }
        $this->validate([
            'picture' => 'image|max:1024',
        ]);

        if ($this->user->picture) {
            $path = public_path().'/storage/'.$this->user->picture;
            unlink($path);
        }

        $this->user->update([
            'picture' => $this->picture->store('profiles', 'public'),
        ]);
        $this->picture = null;
        toast()->success(__('general.updateSuccess'), __('general.success'))->push();
    }

    public function deletePicture()
    {
        if (Auth::user()->cannot('update', $this->user)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        if (! $this->user->picture) {
            toast()->danger(__('general.noPicture'), __('general.error'))->push();

            return;
        }

        $path = public_path().'/storage/'.$this->user->picture;
        unlink($path);
        $this->user->update([
            'picture' => null,
        ]);
        toast()->success(__('general.updateSuccess'), __('general.success'))->push();
    }

    public function updateUser()
    {
        if (Auth::user()->cannot('update', $this->user)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        if (! config('presencetracker.allowChangeNeptunCode') && $this->neptun != $this->user->neptun) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();
            return;
        }

        $this->validate([
            'neptun' => [
                'string', 'max:6', \Illuminate\Validation\Rule::unique('users')->ignore($this->user->id),
                config('presencetracker.requireNeptunCode') ? 'required' : 'nullable',
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($this->user->id),
            ],
        ]);

        $this->user->update([
            'neptun' => Str::upper($this->neptun),
            'name' => $this->name,
            'email' => $this->email,
        ]);
        toast()->success(__('general.updateSuccess'), __('general.success'))->push();

    }

    public function render(
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application {
        return view('livewire.update-profile-component');
    }
}
