<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class SimpleNotification extends Component
{
    public string $title = 'teszt';

    public string $message = 'teszt';

    public int $type = 2;

    public bool $isOpen = false;

    public const TYPE_SUCCESS = 0;

    public const TYPE_ALERT = 1;

    public const TYPE_INFO = 2;

    #[On('sendNotif')]
    public function sendSimpleBrowserNotification($data): void
    {
        $this->title = $data['title'] ?? '';
        $this->message = $data['message'] ?? '';
        $this->type = $data['type'] ?? 0;
        $this->isOpen = true;
        $this->hideSec = $data['hide'] ?? 5;
        $this->dispatch('startTimer', ['timer' => $data['timer'] ?? 5, 'autoHide' => $data['autoHide'] ?? true]);
    }

    public function render()
    {
        return view('livewire.simple-notification');
    }
}
