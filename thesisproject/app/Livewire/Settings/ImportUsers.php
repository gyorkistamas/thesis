<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Notifications\NewUserRegistered;
use Exception;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ImportUsers extends Component
{
    use WireToast, WithFileUploads;

    public $file;

    public $error = false;

    public $resultSuccessNum = 0;

    public $resultFailedNum = 0;

    public $failedRows = [];

    public $enableButton = true;

    public function startImport()
    {
        if (! $this->file) {
            $this->error = true;

            return;
        }
        $this->enableButton = false;
        $this->clearMessages();

        $content = $this->file->get();
        $rows = array_filter(explode(PHP_EOL, $content), fn ($value) => ! is_null($value) && $value !== '');
        foreach ($rows as $row) {
            $data = explode(';', $row);
            try {
                $userData = [
                    'neptun' => trim($data[0]) == '' ? null : \Str::upper(trim($data[0])),
                    'name' => trim($data[1]) == '' ? throw new Exception() : trim($data[1]),
                    'email' => trim($data[2]) == '' ? throw new Exception() : trim($data[2]),
                    'password' => \Hash::make(\Str::random(8)),
                ];

                try {
                    $user = User::create($userData);
                    $user->roles()->updateOrCreate(['role' => 'student']);
                    $token = app(PasswordBroker::class)->createToken($user);
                    $user->notify((new NewUserRegistered($token, $user))->locale(App::getLocale()));
                    $this->resultSuccessNum += 1;
                } catch (Exception $e) {
                    $this->resultFailedNum += 1;
                    $this->failedRows[] = $row.' - '.__('general.alreadExists');
                }

            } catch (Exception $e) {
                $this->resultFailedNum += 1;
                $this->failedRows[] = $row.' - '.__('general.badFormat');
            }
        }

        $this->enableButton = true;
    }

    #[On('clearImportMessages')]
    public function clearMessages()
    {
        $this->error = false;
        $this->resultSuccessNum = 0;
        $this->resultFailedNum = 0;
        $this->failedRows = [];
    }

    public function render()
    {
        return view('livewire.settings.import-users');
    }
}
