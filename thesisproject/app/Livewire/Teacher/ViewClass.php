<?php

namespace App\Livewire\Teacher;

use App\Events\ClassPresenceChanged;
use Livewire\Attributes\On;
use Livewire\Component;
use Str;
use Usernotnull\Toast\Concerns\WireToast;

class ViewClass extends Component
{
    use WireToast;

    public $class;
    public $course;

    public $isQrCodeVisible = false;

    public $loginLink;

    public $loginCode;

    public $students;

    public function mount($class)
    {
        $this->class = $class;
        $this->course = $class->Course;
        $this->class->load('StudentsWithPresence', 'StudentsWithPresence.Justifications', 'StudentsWithPresence.Justifications.Acceptances');
    }

    public function disableQrCode()
    {
        if (! $this->isQrCodeVisible) {
            toast()->danger(__('teacher.noQrCodeGenerated'), __('general.error'))->push();

            return;
        }

        $this->isQrCodeVisible = false;
        $this->loginCode->invalidated = true;
        $this->loginCode->save();

        toast()->success(__('teacher.qrCodeDisabled'), __('general.success'))->push();
    }

    public function generateQrCode()
    {
        if ($this->isQrCodeVisible) {
            toast()->danger(__('teacher.qrCodeAlreadyGenerated'), __('general.error'))->push();

            return;
        }

        $this->loginCode = $this->class->Loginlinks()->create([
            'key' => Str::uuid()->toString(),
        ]);

        $this->isQrCodeVisible = true;
        $this->loginLink = route('student-class-login', ['uuid' => $this->loginCode->key]);
    }

    #[On('refreshChart')]
    public function updateChart()
    {
        $data = [
            0 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'present')->count(),
            1 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'justified')->count(),
            2 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'missing')->count(),
            3 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'late')->count(),
            4 => $this->class->StudentsWithPresence()->wherePivot('attendance', 'not_filled')->count(),
        ];
        $this->dispatch('updateChart', data: $data);
    }

    public function render()
    {
        return view('livewire.teacher.view-class');
    }
}
