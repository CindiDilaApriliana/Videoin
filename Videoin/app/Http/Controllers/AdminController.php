<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Customers;
use App\Models\User;
use App\Models\Video;

class AdminController extends Controller
{
    // Display the dashboard
    public function dashboard()
    {
        // Count the number of customers and videos
        $userCount = User::count();
        $videoCount = Video::count();

        // Pass the counts to the view
        return view('admin.dashboard', [
            'user' => $userCount,
            'video' => $videoCount,
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
