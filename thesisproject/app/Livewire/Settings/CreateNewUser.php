<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Notifications\NewUserRegistered;
use Auth;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateNewUser extends Component
{
    use WireToast;

    public $superadmin = false;

    public $admin = false;

    public $teacher = false;

    public $student = true;

    public $neptun;

    public $name;

    public $email;

    #[On('createNewUser')]
    public function save()
    {
        $this->validate([
            'neptun' => ['nullable', 'string', 'max:6', Rule::unique(User::class), 'uppercase'],
            'name' => 'required|min:2|max:255',
            'email' => ['required', 'email', Rule::unique(User::class)],
        ]);

        if (Auth::user()->cannot('create', User::class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();
            return;
        }

        $user = User::create([
            'neptun' => $this->neptun,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make(\Str::random(8)),
        ]);

        $user->save();

        if ($this->superadmin) {
            $user->roles()->updateOrCreate(['role' => 'superadmin']);
        }
        if ($this->admin) {
            $user->roles()->updateOrCreate(['role' => 'admin']);
        }
        if ($this->teacher) {
            $user->roles()->updateOrCreate(['role' => 'teacher']);
        }
        if ($this->student) {
            $user->roles()->updateOrCreate(['role' => 'student']);
        }

        $token = app(PasswordBroker::class)->createToken($user);
        $user->notify((new NewUserRegistered($token, $user))->locale(App::getLocale()));

        toast()->success(__('general.userCreated'), __('general.success'))->push();
    }

    public function render()
    {
        return view('livewire.settings.create-new-user');
    }
}
