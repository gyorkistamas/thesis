<?php

namespace App\Livewire\Student\Justifications;

use App\Models\Justification;
use App\Models\Subject;
use App\Models\User;
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
        if (Auth::user()->cannot('create', Justification::class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }
        $this->validate();

        $justification = Auth::user()->Justifications()->create([
            'type' => $this->type,
            'start_date' => $this->start,
            'end_time' => $this->end,
            'description' => $this->comment,
        ]);

        $justification->Pictures()->createMany(array_map(function ($image) {
            return ['picture_name' => $image->store('justification_pictures', 'public')];
        }, $this->uploadedPics));

        // assign teachers
        $teachers = User::whereHas('TaughtCourses', function ($query) {
            $query->whereHas('Classes', function ($query) {
                $query->where('start_time', '>=', $this->start);
                $query->where('end_time', '<=', $this->end);

            });
            $query->whereHas('Students', function ($query) {
                $query->where('users.id', Auth::id());
            });
        })
            ->distinct()
            ->get();

        $justification->GetTeachers()->attach($teachers->pluck('id')->toArray());

        $this->type = 'doctor';
        $this->start = null;
        $this->end = null;
        $this->comment = null;
        $this->uploadedPics = [];

        toast()->success(__('student.justificationCreatedTeachersNotified'), __('general.success'))->push();
    }

    public function getAffectedClasses()
    {
        // TODO class creation not show date in subjects
        return Subject::whereHas('Courses', function ($query) {
            $query->whereHas('Students', function ($query) {
                $query->where('users.id', Auth::id());
            });
            $query->whereHas('Classes', function ($query) {
                $query->where('start_time', '>=', $this->start);
                $query->where('end_time', '<=', $this->end);
            });
        })->get();
    }

    public function render()
    {
        return view('livewire.student.justifications.student-justification-page');
    }
}
