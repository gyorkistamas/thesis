<?php

namespace App\Livewire\Student\Justifications;

use App\Models\Subject;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class JustificationItem extends Component
{
    use WireToast;

    public $justification;

    public $isOpened = false;

    public $deleted = false;

    public function mount($justification)
    {
        $this->justification = $justification;
    }

    public function deleteJustification()
    {
        if (\Auth::user()->cannot('delete', $this->justification)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        foreach ($this->justification->Pictures as $picture) {
            $path = public_path().'/storage/'.$picture->picture_name;
            unlink($path);
            $picture->delete();
        }
        foreach ($this->justification->GetTeachers as $response) {
            $response->pivot->delete();
        }

        $this->dispatch('closeDeleteModal', ['id' => $this->justification->id]);
        $temp = $this->justification;
        $this->justification = null;
        $this->deleted = true;
        $temp->delete();
        toast()->success(__('student.justificationDeleted'), __('general.success'))->push();
    }

    public function getAffectedClasses()
    {
        return Subject::whereHas('Courses', function ($query) {
            $query->whereHas('Students', function ($query) {
                $query->where('users.id', $this->justification->user_id);
            });
            $query->whereHas('Classes', function ($query) {
                $query->where('start_time', '>=', $this->justification->start_date);
                $query->where('end_time', '<=', $this->justification->end_time);
            });
        })->get();
    }

    public function render()
    {
        return view('livewire.student.justifications.justification-item');
    }
}
