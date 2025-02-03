<?php

namespace App\Http\Middleware;

namespace App\Http\Middleware;

use Closure;
use App\Models\User; //custom
use Illuminate\Http\Request;
use Session; //custom
use App\Models\Permission; //custom

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Session::has('userId') || Session::get('userId') == null) {
            return redirect()->route('admin.admin-login');
        }

        // Fetch the user based on the session userId
        $user = User::where('status', 1)->where('id', Session::get('userId'))->first();

        // If user is not found or role_id is not 2, redirect
        if (!$user || $user->role_id != 2) {
            \Toastr::warning("You don't have permission to access this page");
            return redirect()->route('admin.login.form'); // or redirect to a different route as needed
        }

        // Allow the request to proceed for users with role_id 2
        return $next($request);
    }
}

