<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class StudentJustifications extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $justification = $this->user->Justifications()
            ->whereHas('Acceptances', function ($query) {
                $query->where('status', 'na');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.landing.student-justifications')->with('justifications', $justification);
    }
}
