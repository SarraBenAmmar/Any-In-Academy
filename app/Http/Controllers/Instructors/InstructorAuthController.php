<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\Auth\SignInRequest;
use App\Http\Requests\Students\Auth\SignUpRequest;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use App\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use App\Models\Role;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class InstructorAuthController extends Controller
{
    public function signUpForm()
    {
        return view('instructor.instructor-register');
    }
    public function signInForm()
    {
        return view('instructor.instructor-login');
    }


    public function signInCheck(SignInRequest $request, $back_route)
    {
        try {
            // Retrieve the instructor by email
            $instructor = Instructor::where('email', $request->email)->first();

            if ($instructor) {
                // Check if the instructor is active
                if ($instructor->status == 1) {
                    // Check if the email is verified
                    if ($instructor->verified_at === null) {
                        return redirect()->back()->with('error', 'Your email is not verified! Please check your email for the verification link.');
                    }

                    // Check if the password matches
                    if (Hash::check($request->password, $instructor->password)) {
                        // Set the session for the logged-in instructor
                        $this->setSession($instructor);

                        // Redirect to the provided back route
                        return redirect()->route($back_route)->with('success', 'Successfully Logged In');
                    } else {
                        return redirect()->back()->with('error', 'Invalid Email or Password');
                    }
                } else {
                    return redirect()->back()->with('error', 'You are not an active user! Please contact the authority.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        } catch (Exception $e) {
            // Log the exception for debugging
            \Log::error('Sign In Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while signing in. Please try again later.');
        }
    }




    public function signUpStore(SignUpRequest $request, $back_route)
    {
        try {
            DB::beginTransaction();

            // Create the user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 3; // Assuming role_id for instructor is 3
            $user->verified_at = null; // Set to null initially
            $user->save();
            // Send verification email
            $user->notify(new VerifyEmail('instructor'));

            // Create the instructor and associate it with the user
            $instructor = new Instructor();
            $instructor->user_id = $user->id; // Link instructor to user
            $instructor->name = $request->name;
            $instructor->email = $request->email;
            $instructor->contact = $request->phone;
            $instructor->password = Hash::make($request->password); // Store the hashed password
            $instructor->verified_at = null; // Set to null initially
            $instructor->role_id = 3;
            $instructor->save(); // Ensure this line is executed

            DB::commit();

            return redirect()->route($back_route)->with('success', 'Successfully Registered! Please check your email to verify your account.');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('danger', 'Error: ' . $e->getMessage());
        }
    }






    public function setSession($instructor)
    {
        request()->session()->put(
            [
                'userId' => encryptor('encrypt', $instructor->user_id),
                'userName' => encryptor('encrypt', $instructor->name),
                'emailAddress' => encryptor('encrypt', $instructor->email),
                'instructorLogin' => 1,
                'image' => $instructor->image ?? 'No Image Found',
            ]
        );

        // Log session data for debugging
        \Log::info('Session Data:', request()->session()->all());
    }



    public function signOut()
    {
        request()->session()->flush();
        return redirect()->route('instructorLogin')->with('danger', 'Successfully Logged Out');
    }
}
