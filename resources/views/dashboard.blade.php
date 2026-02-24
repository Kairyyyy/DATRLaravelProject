<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="glass-card p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold neon-text mb-2">
                            Welcome back, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-gray-400 text-lg">
                            {{ Carbon\Carbon::now('Asia/Manila')->format('l, F j, Y') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="time-display text-3xl realtime-clock">
                            {{ Carbon\Carbon::now('Asia/Manila')->format('h:i A') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @php
                    $user = Auth::user();
                    $today = Carbon\Carbon::today('Asia/Manila');
                    $todayAttendance = App\Models\AttendanceRecord::where('user_id', $user->id)
                        ->whereDate('date', $today)
                        ->first();
                    $totalDays = App\Models\AttendanceRecord::where('user_id', $user->id)->count();
                    $totalHours = App\Models\AttendanceRecord::where('user_id', $user->id)->sum('total_hours');
                @endphp

                <div class="stat-card">
                    <div class="stat-value">{{ $totalDays }}</div>
                    <div class="stat-label">Total Days Logged</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">{{ number_format($totalHours, 1) }}</div>
                    <div class="stat-label">Total Hours</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">
                        @if($todayAttendance && $todayAttendance->time_in && !$todayAttendance->time_out)
                            <span class="text-yellow-400">Active</span>
                        @elseif($todayAttendance && $todayAttendance->time_out)
                            <span class="text-green-400">Completed</span>
                        @else
                            <span class="text-gray-400">Not Started</span>
                        @endif
                    </div>
                    <div class="stat-label">Today's Status</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="glass-card p-6">
                <h3 class="text-xl font-semibold mb-4 neon-text">Quick Actions</h3>
                <div class="flex space-x-4">
                    <a href="{{ route('attendance.index') }}" class="btn-futuristic">
                        Go to Attendance
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>