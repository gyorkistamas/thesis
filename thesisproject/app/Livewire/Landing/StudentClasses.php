<?php

namespace App\Livewire\Landing;

use Carbon\Carbon;
use Livewire\Component;

class StudentClasses extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $classes = $this->user->GetClassesWithPresence()
            ->whereDate('start_time', Carbon::today())
            ->get()
            ->sortBy([
                ['start_time', 'asc'],
                [
                    function ($class) {
                        return $class->isOnGoing();
                    }, 'asc',
                ],
            ]);

        return view('livewire.landing.student-classes')->with([
            'classes' => $classes,
        ]);
    }
}
