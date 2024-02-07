<?php

namespace App\Livewire\Teacher;

use App\Models\Subject;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class SubjectCourseView extends Component
{
    use WireToast, WithPagination;

    public function render()
    {
        $subjects = Subject::whereHas('Courses', function ($query) {
            return $query->whereHas('Teachers', function ($query) {
                return $query->where('users.id', Auth::user()->id);
            });
        })->paginate(10);

        return view('livewire.teacher.subject-course-view')->with('subjects', $subjects);
    }
}
