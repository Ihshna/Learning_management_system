<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;
use Carbon\Carbon;


class AdminDashboardController extends Controller
{
    public function index()
{
    $user=Auth::user();
    if(!$user || $user->role!=='admin'){
        return redirect('/login');
    }

   // Total Counts for Cards
   $totalStudents = User::where('role', 'student')->count();
   $totalCourses = Course::count();
   $totalAssignments = Assignment::count();

   // Chart Data for Last 12 Months
   $months = [];
   $studentCounts = [];

   for ($i = 0; $i < 12; $i++) {
       $monthName = Carbon::now()->subMonths($i)->format('F');
       $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
       $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();

       $count = User::where('role', 'student')
           ->whereBetween('created_at', [$monthStart, $monthEnd])
           ->count();

       $months[] = $monthName;
       $studentCounts[] = $count;
   }

   $months = array_reverse($months);
   $studentCounts = array_reverse($studentCounts);

   return view('admin.dashboard', compact(
       'totalStudents',
       'totalCourses',
       'totalAssignments',
       'months',
       'studentCounts'
   ));
}
}
