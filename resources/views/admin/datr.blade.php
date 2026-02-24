<x-admin-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @php
                    $today = \Carbon\Carbon::today('Asia/Manila');
                    $totalToday = App\Models\AttendanceRecord::whereDate('date', $today)->count();
                    $completedToday = App\Models\AttendanceRecord::whereDate('date', $today)
                                        ->whereNotNull('time_out')->count();
                    $activeToday = App\Models\AttendanceRecord::whereDate('date', $today)
                                        ->whereNotNull('time_in')
                                        ->whereNull('time_out')->count();
                    $totalHoursToday = App\Models\AttendanceRecord::whereDate('date', $today)
                                        ->sum('total_hours');
                @endphp

                <div class="stat-card">
                    <div class="stat-value">{{ $totalToday }}</div>
                    <div class="stat-label">Total Today</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">{{ $completedToday }}</div>
                    <div class="stat-label">Completed</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">{{ $activeToday }}</div>
                    <div class="stat-label">Active Now</div>
                </div>              
            </div>

            <!-- Attendance Records Table -->
            <div class="glass-card p-8">
                <h3 class="text-xl font-semibold mb-6 neon-text">All Attendance Records</h3>

                <div class="overflow-x-auto">
                    <table class="cyber-table">
                        <thead>
                            <tr>
                                <th>USER ID</th>
                                <th>INTERN</th>
                                <th>DATE</th>
                                <th>DAY</th>
                                <th>TIME IN</th>
                                <th>TIME OUT</th>
                                <th>TOTAL HOURS</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendanceRecords as $record)
                                <tr>
                                    <td class="font-mono">{{ str_pad($record->user_id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="font-semibold">{{ $record->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->date)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->date)->format('l') }}</td>
                                    <td class="font-mono text-green-400">
                                        {{ $record->time_in ? \Carbon\Carbon::parse($record->time_in)->timezone('Asia/Manila')->format('h:i A') : '---' }}
                                    </td>
                                    <td class="font-mono text-red-400">
                                        {{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->timezone('Asia/Manila')->format('h:i A') : '---' }}
                                    </td>
                                    <td class="font-mono text-blue-400" style="width: 100%;">
                                        {{ $record->total_hours ? number_format(abs($record->total_hours), 2) . ' hrs' : '---' }}
                                    </td>
                                    <td>
                                        @if($record->time_in && $record->time_out)
                                            <span class="status-badge present">COMPLETED</span>
                                        @elseif($record->time_in)
                                            <span class="status-badge present">ACTIVE</span>
                                        @else
                                            <span class="status-badge absent">ABSENT</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-8 text-gray-400">
                                        No attendance records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $attendanceRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>