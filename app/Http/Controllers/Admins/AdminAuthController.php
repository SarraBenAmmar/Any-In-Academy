<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\Auth\SignInRequest;
use App\Http\Requests\Students\Auth\SignUpRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class AdminAuthController extends Controller
{
    public function signUpForm()
    {
        return view('admin.admin-register');
    }

    public function signUpStore(SignUpRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create a new user record
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 2; // Assurez-vous que le role_id est correct pour les admins
            $user->save();

            DB::commit();

            $this->setSession($user);
            return redirect()->route('admin.dashboard')->with('success', 'Successfully Registered and Logged In');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('danger', 'Error: ' . $e->getMessage());
            dd($e);
        }
    }

    public function signInForm()
    {
        return view('admin.admin-login');
    }

    public function signInCheck(SignInRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if ($user->status == 1 && $user->role_id == 2) {
                    if (Hash::check($request->password, $user->password)) {
                        $this->setSession($user);
                        return redirect()->route('dashboard')->with('success', 'Successfully Logged In');
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
            dd($e);
            return redirect()->back()->withErrors(['exception' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function setSession($user)
    {
        return request()->session()->put(
            [
                'userId' => encryptor('encrypt', $user->id),
                'userName' => encryptor('encrypt', $user->name),
                'emailAddress' => encryptor('encrypt', $user->email),
                'userLogin' => 1,
                'image' => $user->image ?? 'No Image Found'
            ]
        );
    }

    public function signOut()
    {
        request()->session()->flush();
        return redirect()->route('userLogin')->with('danger', 'Successfully Logged Out');
    }
}
