<?php

namespace App\Livewire\Settings;

use Brotzka\DotenvEditor\DotenvEditor;
use Livewire\Component;

class Config extends Component
{
    private $editor;

    public $siteName;

    public $allowRegister;

    public $logo;

    public $allowChange;

    public $requireNeptun;

    public function mount()
    {
        $this->editor = new DotenvEditor();

        $this->siteName = env('SITENAME');
        $this->allowRegister = env('ALLOWREGISTER');
        $this->logo = env('LOGO');
        $this->allowChange = env('ALLOW_CHANGE_NEPTUN_CODE');
        $this->requireNeptun = env('REQUIRE_NEPTUN_CODE');
    }

    public function render()
    {
        return view('livewire.settings.config');
    }
}
