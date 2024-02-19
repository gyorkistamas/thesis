<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class TeacherJustifications extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $justification = $this->user->AssignedJustifications()
            ->where('status', 'na')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.landing.teacher-justifications')->with('justifications', $justification);
    }
}
