<?php

namespace App\Livewire\Student\Justifications;

use App\Models\Justification;
use App\Models\Subject;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class StudentJustificationPage extends Component
{
    use WireToast, WithFileUploads, WithPagination;

    #[Validate('required|string|in:doctor,other')]
    public $type = 'doctor';

    #[Validate('required|date')]
    public $start;

    #[Validate('required|date|after:start')]
    public $end;

    public $comment;

    #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];

    #[Validate(['uploadedPics.*' => 'image|max:1024'])]
    public $uploadedPics = [];

    public function removeImage($index)
    {
        array_splice($this->uploadedPics, $index, 1);
    }

    public function uploadPics()
    {
        $this->validate(['images.*' => 'image|max:1024']);

        if (! $this->uploadedPics) {
            $this->uploadedPics = $this->images;
        } else {
            array_push($this->uploadedPics, ...$this->images);
        }
        $this->images = [];
        $this->dispatch('clearFileUpload');
    }

    public function createJustification()
    {
        dd($this->getAffectedClasses());

        if (Auth::user()->cannot('create', Justification::class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->validate();
    }

    public function getAffectedClasses()
    {
        // TODO class creation not show date in subjects
        $subjects = Subject::whereHas('Courses', function ($query) {
            $query->whereHas('Students', function ($query) {
                $query->where('users.id', Auth::id());
            });
            $query->whereHas('Classes', function ($query) {
                $query->where('start_time', '>=', $this->start);
                $query->where('end_time', '<=', $this->end);
            });
        })->get();
        return $subjects;
    }

    public function render()
    {
        return view('livewire.student.justifications.student-justification-page');
    }
}
