<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::get();
        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', get_defined_vars());
    }
}
