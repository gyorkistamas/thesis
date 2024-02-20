<?php

namespace App\Http\Controllers;

use App\Models\CourseClass;
use Auth;

class TeacherController extends Controller
{
    public function teacherSubjects()
    {
        return view('teacher.subjects');
    }

    public function teacherClass(CourseClass $courseClass)
    {
        if (Auth::user()->cannot('view', $courseClass)) {
            abort(403);
        }

        return view('teacher.view-course')->with('courseClass', $courseClass);
    }

    public function getJustifications()
    {
        return view('teacher.justifications');
    }
}
