<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class LandingPageController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'approved')->latest()->take(6)->get();
        return view('landing', compact('courses'));
    }
}
