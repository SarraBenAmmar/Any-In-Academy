<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyStudent(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!$user || !$request->hasValidSignature()) {
            return redirect('/')->with('danger', 'Invalid verification link.');
        }

        // Update the verified_at field in the users table
        $user->verified_at = now();
        $user->save();

        // Update the verified_at field in the students table
        $student = Student::where('user_id', $user->id)->first();
        if ($student) {
            $student->verified_at = now();
            $student->save();
        }

        // Redirect to a success page
        return redirect('/')->with('success', 'Email verified successfully!');
    }

    public function verifyInstructor(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!$user || !$request->hasValidSignature()) {
            return redirect('/')->with('danger', 'Invalid verification link.');
        }

        // Update the verified_at field in the users table
        $user->verified_at = now();
        $user->save();

        // Update the verified_at field in the instructor table
        $instructor = Instructor::where('user_id', $user->id)->first();
        if ($instructor) {
            $instructor->verified_at = now();
            $instructor->save();
        }

        // Redirect to a success page
        return redirect('/')->with('success', 'Email verified successfully!');
    }
}
