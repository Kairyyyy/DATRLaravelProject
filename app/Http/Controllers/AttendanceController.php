<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today('Asia/Manila');
        
        // Get today's attendance record
        $todayAttendance = AttendanceRecord::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();
        
        // Get all attendance records for the user
        $attendanceRecords = AttendanceRecord::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();
        
        return view('attendance.index', compact('todayAttendance', 'attendanceRecords'));
    }

    public function timeIn()
    {
        $user = Auth::user();
        $today = Carbon::today('Asia/Manila');
        
        // Check if user already has a record for today
        $existingRecord = AttendanceRecord::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();
        
        if ($existingRecord && $existingRecord->time_in) {
            return redirect()->route('attendance.index')
                ->with('error', 'You have already timed in for today.');
        }
        
        // Create new attendance record with current time in Asia/Manila timezone
        $now = Carbon::now('Asia/Manila');
        
        AttendanceRecord::create([
            'user_id' => $user->id,
            'date' => $today,
            'time_in' => $now,
        ]);
        
        return redirect()->route('attendance.index')
            ->with('success', 'Timed in successfully at ' . $now->format('h:i A'));
    }

    public function timeOut()
    {
        $user = Auth::user();
        $today = Carbon::today('Asia/Manila');
        
        // Get today's attendance record
        $attendance = AttendanceRecord::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();
        
        if (!$attendance) {
            return redirect()->route('attendance.index')
                ->with('error', 'You need to time in first.');
        }
        
        if ($attendance->time_out) {
            return redirect()->route('attendance.index')
                ->with('error', 'You have already timed out for today.');
        }
        
        // Update time_out with current time in Asia/Manila timezone
        $timeOut = Carbon::now('Asia/Manila');
        $timeIn = Carbon::parse($attendance->time_in)->timezone('Asia/Manila');
        
        // Calculate total hours (ensure positive value)
        $totalHours = number_format(abs($timeOut->diffInMinutes($timeIn) / 60), 2);
        
        $attendance->update([
            'time_out' => $timeOut,
            'total_hours' => $totalHours,
        ]);
        
        return redirect()->route('attendance.index')
            ->with('success', 'Timed out successfully at ' . $timeOut->format('h:i A') . ' (Total: ' . $totalHours . ' hrs)');
    }
}