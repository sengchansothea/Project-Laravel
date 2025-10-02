<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Count Admins
        // $data['admin_count'] = User::where('user_type', 1)
        //     ->where('is_delete', 0)
        //     ->count();

        $data['header_title'] = 'Dashboard';

        if (Auth::user()->user_type == 1) {
            return view('admin.dashboard', $data);
        } else if (Auth::user()->user_type == 2) {
            return view('dept_admin.dashboard', $data);
        } else if (Auth::user()->user_type == 3) {
            return view('CEO.dashboard', $data);
        } else if (Auth::user()->user_type == 4) {
            return view('HR_manager.dashboard', $data);
        } else if (Auth::user()->user_type == 5) {
            return view('CFO.dashboard', $data);
        } else if (Auth::user()->user_type == 6) {
            return view('teamLeader.dashboard', $data);
        }else if (Auth::user()->user_type == 7) {
            return view('employee.dashboard', $data);
        }
    }
}
