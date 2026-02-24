<x-admin-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="glass-card p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold neon-text mb-2">
                            Welcome back, Admin {{ Auth::guard('admin')->user()->name ?? 'Admin' }}!
                        </h1>
                        <p class="text-gray-400 text-lg">
                            {{ \Carbon\Carbon::now('Asia/Manila')->format('l, F j, Y') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="time-display text-3xl realtime-clock">
                            {{ \Carbon\Carbon::now('Asia/Manila')->format('h:i A') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="stat-card">
                    <div class="stat-value">{{ $stats['total_users'] }}</div>
                    <div class="stat-label">Total Interns</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">{{ $stats['total_attendance'] }}</div>
                    <div class="stat-label">Total Records</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">{{ $stats['active_today'] }}</div>
                    <div class="stat-label">Active Today</div>
                </div>

                <div class="stat-card">
                    <div class="stat-value">{{ $stats['completed_today'] }}</div>
                    <div class="stat-label">Completed Today</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="glass-card p-6">
                    <h3 class="text-xl font-semibold mb-4 neon-text">Quick Actions</h3>
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('admin.interns') }}" class="btn-futuristic text-center">
                            View All Interns
                        </a>
                        <a href="{{ route('admin.datr') }}" class="btn-futuristic text-center">
                            View Attendance Records
                        </a>
                    </div>
                </div>

                <div class="glass-card p-6">
                    <h3 class="text-xl font-semibold mb-4 neon-text">Today's Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Present Today:</span>
                            <span class="text-cyan-400 font-bold">{{ $stats['active_today'] + $stats['completed_today'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Absent Today:</span>
                            <span class="text-red-400 font-bold">{{ $stats['total_users'] - ($stats['active_today'] + $stats['completed_today']) }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden mt-2">
                            <div class="h-full bg-gradient-to-r from-cyan-500 to-purple-600" 
                                 style="width: {{ $stats['total_users'] > 0 ? (($stats['active_today'] + $stats['completed_today']) / $stats['total_users'] * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>