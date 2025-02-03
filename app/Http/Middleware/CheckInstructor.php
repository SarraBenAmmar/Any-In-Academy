<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CheckInstructor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Session::has('userId')) {
            return redirect()->route('instructorLogin.form');
        }

        // Decrypt the userId
        $decryptedUserId = encryptor('decrypt', Session::get('userId'));

        // Fetch the user based on the decrypted userId
        $user = User::where('status', 1)->where('id', $decryptedUserId)->first();

        // If user is not found or role_id is not 3, redirect
        if (!$user || $user->role_id != 3) {
            \Toastr::warning("You don't have permission to access this page");
            return redirect()->route('instructorLogin.form');
        }

        // Allow the request to proceed for users with role_id 3
        return $next($request);
    }


}
