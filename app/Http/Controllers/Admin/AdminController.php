<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\AttendanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_attendance' => AttendanceRecord::count(),
            'active_today' => AttendanceRecord::whereDate('date', now()->toDateString())
                                ->whereNotNull('time_in')
                                ->whereNull('time_out')
                                ->count(),
            'completed_today' => AttendanceRecord::whereDate('date', now()->toDateString())
                                ->whereNotNull('time_out')
                                ->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    public function interns()
    {
        $users = User::with(['attendanceRecords' => function($query) {
            $query->latest()->take(1);
        }])->get();
        
        return view('admin.interns', compact('users'));
    }

    public function showIntern(User $user)
    {
        $user->load(['attendanceRecords' => function($query) {
            $query->latest()->paginate(15);
        }]);
        
        return view('admin.interns-show', compact('user'));
    }

    public function datr()
    {
        $attendanceRecords = AttendanceRecord::with('user')
            ->latest()
            ->paginate(20);
        
        return view('admin.datr', compact('attendanceRecords'));
    }

    public function userAttendance(User $user)
    {
        $attendanceRecords = $user->attendanceRecords()
            ->latest()
            ->paginate(20);
        
        return view('admin.user-attendance', compact('user', 'attendanceRecords'));
    }

    public function exportDatr()
    {
        $attendanceRecords = AttendanceRecord::with('user')
            ->latest()
            ->get();
        
        return back()->with('info', 'Export feature coming soon!');
    }

    /**
     * Display list of all admins
     */
    public function admins()
    {
        $admins = Admin::orderBy('name')->get();
        
        return view('admin.admins', compact('admins'));
    }

    /**
     * Show specific admin details
     */
    public function showAdmin(Admin $admin)
    {
        return view('admin.admins-show', compact('admin'));
    }
}