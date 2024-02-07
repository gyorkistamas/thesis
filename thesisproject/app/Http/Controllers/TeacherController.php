<?php

namespace App\Http\Controllers;

use App\Models\CourseClass;

class TeacherController extends Controller
{
    public function teacherSubjects()
    {
        return view('teacher.subjects');
    }

    public function teacherClass(CourseClass $courseClass)
    {
        return view('layout.default_layout');
    }
}
