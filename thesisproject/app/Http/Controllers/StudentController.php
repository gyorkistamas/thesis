<?php

namespace App\Http\Controllers;

use App\Models\ClassLoginLink;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function loginToClass($uuid)
    {
        $loginuuid = ClassLoginLink::where('key', $uuid)
            ->where('invalidated', false)
            ->first();

        if ($loginuuid == null) {
            return abort(404);
        }

        return redirect()->route('student-class-login-link')->with('classid', $loginuuid->course_class_id);
    }

    public function getLoginLink(Request $request)
    {
        if ($request->session()->get('classid') == null) {
            return abort(404);
        }

        return view('student.login-to-class')->with(['classId' => $request->session()->get('classid')]);
    }
}
