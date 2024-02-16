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
        return view('teacher.view-course')->with('courseClass', $courseClass);
    }

    public function getJustifications()
    {
        return view('teacher.justifications');
    }
}
