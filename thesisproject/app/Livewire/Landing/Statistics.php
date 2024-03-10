<?php

namespace App\Livewire\Landing;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Justification;
use App\Models\Place;
use App\Models\Subject;
use App\Models\Term;
use App\Models\User;
use DB;
use Livewire\Component;

class Statistics extends Component
{
    public function GetUserStatistics()
    {
        $users = User::all();
        $students = 0;
        $teachers = 0;
        $admins = 0;
        $superadmins = 0;
        foreach ($users as $user) {
            if ($user->hasRole('student')) {
                $students++;
            }
            if ($user->hasRole('teacher')) {
                $teachers++;
            }
            if ($user->hasRole('admin')) {
                $admins++;
            }
            if ($user->hasRole('superadmin')) {
                $superadmins++;
            }
        }
        return [
            $teachers,
            $students,
            $admins,
            $superadmins,
        ];
    }

    public function CountStatistics()
    {
        return [
            Term::count(),
            Place::count(),
            Subject::count(),
            Course::count(),
            CourseClass::count(),
            Justification::count(),
        ];
    }

    public function PresenceCount()
    {
        return [
            Attendance::where('attendance', 'present')->count(),
            Attendance::where('attendance', 'justified')->count(),
            Attendance::where('attendance', 'missing')->count(),
            Attendance::where('attendance', 'late')->count(),
            Attendance::where('attendance', 'not_filled')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.landing.statistics');
    }
}
