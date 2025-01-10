<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class CoursesController extends Controller
{
    public function index()
    {
        // $cart = Cart::with('courses')->where('session_id', session()->getId())->first();
        $courses = Course::get();
        return view('admin.courses.index', get_defined_vars());
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', get_defined_vars());
    }
}
