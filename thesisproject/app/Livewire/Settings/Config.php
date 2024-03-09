<?php

namespace App\Livewire\Settings;

use Artisan;
use Auth;
use Brotzka\DotenvEditor\DotenvEditor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class Config extends Component
{
    use WireToast, WithFileUploads;

    public $siteName;

    public $allowRegister;

    public $logo;

    public $allowChange;

    public $requireNeptun;

    public function mount()
    {
        $this->siteName = config('presencetracker.sitename');
        $this->allowRegister = config('presencetracker.enableRegister');
        $this->logo = config('presencetracker.logo');
        $this->allowChange = config('presencetracker.allowChangeNeptunCode');
        $this->requireNeptun = config('presencetracker.requireNeptunCode');
    }

    public function save()
    {
        if (! Auth::user()->hasRole('superadmin')) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->validate([
            'siteName' => 'required|string|max:255',
            'allowRegister' => 'bool',
            'logo' => 'nullable',
            'allowChange' => 'bool',
            'requireNeptun' => 'bool',
        ]);

        $editor = new DotenvEditor();

        toast()->success(__('config.changesSavedReload'), __('general.success'))->push();
        if ($this->logo != config('presencetracker.logo')) {
            $this->logo = $this->logo->store('logos', 'public');
            $this->logo = 'storage/'.str_replace('public/', '', $this->logo);

            $editor->changeEnv([
                'SITENAME' => '"'.$this->siteName.'"',
                'ALLOWREGISTER' => $this->allowRegister ? 'true' : 'false',
                'LOGO' => '"'.$this->logo.'"',
                'ALLOW_CHANGE_NEPTUN_CODE' => $this->allowChange ? 'true' : 'false',
                'REQUIRE_NEPTUN_CODE' => $this->requireNeptun ? 'true' : 'false',
            ]);
        } else {
            $editor->changeEnv([
                'SITENAME' => '"'.$this->siteName.'"',
                'ALLOWREGISTER' => $this->allowRegister ? 'true' : 'false',
                'ALLOW_CHANGE_NEPTUN_CODE' => $this->allowChange ? 'true' : 'false',
                'REQUIRE_NEPTUN_CODE' => $this->requireNeptun ? 'true' : 'false',
            ]);
        }
        Artisan::call('config:cache');
    }

    public function render()
    {
        return view('livewire.settings.config');
    }
}
