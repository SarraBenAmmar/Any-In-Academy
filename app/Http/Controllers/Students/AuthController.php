<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Http\Requests\Students\Auth\SignUpRequest;
use App\Http\Requests\Students\Auth\SignInRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signUpForm()
    {
        return view('students.auth.register');
    }

    public function signUpStore(SignUpRequest $request, $back_route)
    {
        try {
            DB::beginTransaction();

            // Create a new user record
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 4; // Assuming role_id for student is 4
            $user->verified_at = null; // Set to null initially
            $user->save();
            $user->notify(new VerifyEmail('student'));

            // Create a new student record linked to the user
            $student = new Student();
            $student->user_id = $user->id; // Assign user_id
            $student->name = $request->name;
            $student->email = $request->email;
            $student->password = $user->password; // Store the hashed password
            $student->verified_at = null; // Set to null initially
            $student->save();



            DB::commit();

            return redirect()->route($back_route)->with('success', 'Successfully Registered! Please check your email to verify your account.');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('danger', 'Error: ' . $e->getMessage());
        }
    }


    public function signInForm()
    {
        return view('students.auth.login');
    }


    public function signInCheck(SignInRequest $request, $back_route)
    {
        try {
            $validated = $request->validated();
            $student = Student::where('email', $request->email)->first();

            if ($student) {
                if ($student->status == 1) {
                    // Check if the email is verified
                    if ($student->verified_at === null) {
                        return redirect()->back()->withErrors(['verification' => 'Your email is not verified! Please check your email for the verification link.']);
                    }

                    if (Hash::check($request->password, $student->password)) {
                        $this->setSession($student);
                        return redirect()->route($back_route)->with('success', 'Successfully Logged In');
                    } else {
                        return redirect()->back()->withErrors(['password' => 'Email or Password is wrong!']);
                    }
                } else {
                    return redirect()->back()->withErrors(['status' => 'You are not an active user! Please contact Authority']);
                }
            } else {
                return redirect()->back()->withErrors(['email' => 'Email or Password is wrong!']);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['exception' => 'An error occurred: ' . $e->getMessage()]);
        }
    }



    public function setSession($student)
    {
        return request()->session()->put(
            [
                'userId' => encryptor('encrypt', $student->id),
                'userName' => encryptor('encrypt', $student->name_en),
                'emailAddress' => encryptor('encrypt', $student->email),
                'studentLogin' => 1,
                'image' => $student->image ?? 'No Image Found'
            ]
        );
    }

    public function signOut()
    {
        request()->session()->flush();
        return redirect()->route('studentLogin')->with('danger', 'Successfully Logged Out');
    }
}
