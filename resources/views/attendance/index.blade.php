<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert-futuristic success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-futuristic error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Time In/Out Section -->
            <div class="glass-card p-8 mb-8 gradient-border">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h3 class="text-2xl font-semibold neon-text mb-4 md:mb-0">
                        {{ Carbon\Carbon::now('Asia/Manila')->format('l, F j, Y') }}
                    </h3>
                    <div class="time-display text-2xl realtime-clock">
                        {{ Carbon\Carbon::now('Asia/Manila')->format('h:i A') }}
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <!-- Time In Button -->
                    <form action="{{ route('attendance.time-in') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="btn-futuristic btn-time-in {{ $todayAttendance && $todayAttendance->time_in ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $todayAttendance && $todayAttendance->time_in ? 'disabled' : '' }}>
                            <span class="relative z-10">Time In</span>
                        </button>
                    </form>

                    <!-- Time Out Button -->
                    <form action="{{ route('attendance.time-out') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="btn-futuristic btn-time-out {{ !$todayAttendance || !$todayAttendance->time_in || $todayAttendance->time_out ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ !$todayAttendance || !$todayAttendance->time_in || $todayAttendance->time_out ? 'disabled' : '' }}>
                            <span class="relative z-10">Time Out</span>
                        </button>
                    </form>
                </div>

                @if($todayAttendance)
                    <div class="mt-6 p-6 bg-black bg-opacity-30 rounded-xl border border-gray-800">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <span class="text-gray-400 block mb-1">Time In</span>
                                <span class="text-2xl font-mono text-green-400">
                                    {{ $todayAttendance->time_in ? Carbon\Carbon::parse($todayAttendance->time_in)->timezone('Asia/Manila')->format('h:i A') : '---' }}
                                </span>
                            </div>
                            @if($todayAttendance->time_out)
                            <div>
                                <span class="text-gray-400 block mb-1">Time Out</span>
                                <span class="text-2xl font-mono text-red-400">
                                    {{ Carbon\Carbon::parse($todayAttendance->time_out)->timezone('Asia/Manila')->format('h:i A') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-400 block mb-1">Total Hours</span>
                                <span class="text-2xl font-mono text-blue-400">
                                    {{ number_format(abs($todayAttendance->total_hours), 2) }} hrs
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Attendance Records Table -->
            <div class="glass-card p-8">
                <h3 class="text-xl font-semibold mb-6 neon-text">Attendance History</h3>

                <div class="overflow-x-auto">
                    <table class="cyber-table">
                        <thead>
                            <tr>
                                <th>DAY</th>
                                <th>DATE</th>
                                <th>TIME IN</th>
                                <th>TIME OUT</th>
                                <th>TOTAL HOURS</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendanceRecords as $record)
                                <tr>
                                    <td class="font-semibold">{{ Carbon\Carbon::parse($record->date)->format('l') }}</td>
                                    <td>{{ Carbon\Carbon::parse($record->date)->format('Y-m-d') }}</td>
                                    <td class="font-mono text-green-400">
                                        {{ $record->time_in ? Carbon\Carbon::parse($record->time_in)->timezone('Asia/Manila')->format('h:i A') : '---' }}
                                    </td>
                                    <td class="font-mono text-red-400">
                                        {{ $record->time_out ? Carbon\Carbon::parse($record->time_out)->timezone('Asia/Manila')->format('h:i A') : '---' }}
                                    </td>
                                    <td class="font-mono total-hours-cell">
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
                                    <td colspan="6" class="text-center py-8 text-gray-400">
                                        No attendance records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>