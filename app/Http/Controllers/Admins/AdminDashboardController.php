<?php
namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
public function index()
{
    return view('admin.adminDashboard');

}
}
