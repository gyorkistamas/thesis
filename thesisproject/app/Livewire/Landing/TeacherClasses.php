<?php

namespace App\Livewire\Landing;

use App\Models\CourseClass;
use Carbon\Carbon;
use Livewire\Component;

class TeacherClasses extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $classes = CourseClass::whereHas('Course', function ($query) {
            $query->whereHas('Teachers', function ($query) {
                $query->where('user_id', $this->user->id);
            });
        })
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

        return view('livewire.landing.teacher-classes')->with(['classes' => $classes]);
    }
}
