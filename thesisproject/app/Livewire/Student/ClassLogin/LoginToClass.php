<?php

namespace App\Livewire\Student\ClassLogin;

use App\Events\ClassPresenceChanged;
use App\Models\CourseClass;
use Auth;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class LoginToClass extends Component
{
    use WireToast;

    public $student;

    public $attendance;

    public function mount($classId)
    {
        $class = CourseClass::findorFail($classId);
        $student = $class->GetStudent(Auth::user()->id)->first();
        if ($student == null) {
            abort(404);
        }
        $this->student = $student;
        $this->attendance = $student->pivot;

    }

    public function setPresence()
    {
        $this->attendance->refresh();
        if ($this->attendance->attendance != 'not_filled') {
            toast()->danger(__('student.presenceAlreadySetCannotModifyHere'), __('general.error'))->push();

            return;
        }

        $this->attendance->attendance = 'present';
        $this->attendance->save();
        $event = ClassPresenceChanged::dispatch($this->attendance);
    }

    public function render()
    {
        return view('livewire.student.class-login.login-to-class');
    }
}
