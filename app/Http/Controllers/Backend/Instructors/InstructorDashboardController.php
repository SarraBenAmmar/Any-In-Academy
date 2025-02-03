<?php
namespace App\Http\Controllers\Backend\Instructors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{
    public function index()
    {
        // You can retrieve any necessary data to pass to the view here
        // For example, you might want to get the instructor's information or courses they teach

        // Example: Retrieve the authenticated instructor

        // Pass data to the view
        return view('instructor.instructorDashboard');
    }
}
