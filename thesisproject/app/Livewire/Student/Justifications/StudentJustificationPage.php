<?php

namespace App\Livewire\Student\Justifications;

use App\Models\Justification;
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
        // TODO show actual error messages
        $this->validate();
    }

    public function render()
    {
        return view('livewire.student.justifications.student-justification-page');
    }
}
