<?php

namespace App\Livewire\Teacher\Justifications;

use App\Models\Subject;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class JustificationListItem extends Component
{
    use WireToast;

    public $justification;

    public $isOpened = false;

    #[Validate('required|string|in:accepted,denied')]
    public $accept;

    #[Validate('nullable|string|max:255')]
    public $reason;

    public $justificationResponse;

    public function mount($justification)
    {
        $this->justification = $justification;
        $this->justificationResponse = $this->justification->GetTeacherResponse(Auth::user()->id)->first();

        if ($this->justificationResponse->status != 'na') {
            $this->accept = $this->justificationResponse->status;
        }
        $this->reason = $this->justificationResponse->comment;
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
            $query->whereHas('Teachers', function ($query) {
                $query->where('users.id', Auth::user()->id);
            });
        })->get();
    }

    public function saveResponse()
    {
        $this->validate();

        if (Auth::user()->cannot('update', $this->justificationResponse)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        if ($this->accept == 'accepted') {
            $this->reason = null;
        }

        $this->justificationResponse->update([
            'status' => $this->accept,
            'comment' => $this->reason,
        ]);

        $this->justificationResponse->save();

        // TODO handle classes if accepted
        // TODO send message to student
        // TODO display comment on student page

        toast()->success(__('teacher.responseSaved'), __('general.success'))->push();
    }

    public function render()
    {
        return view('livewire.teacher.justifications.justification-list-item');
    }
}
