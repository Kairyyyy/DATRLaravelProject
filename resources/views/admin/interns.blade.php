<x-admin-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stat-card">
                    <div class="stat-value">{{ $users->count() }}</div>
                    <div class="stat-label">Total Interns</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">{{ $users->filter(function($user) { 
                        return $user->attendanceRecords->isNotEmpty(); 
                    })->count() }}</div>
                    <div class="stat-label">Active Interns</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">{{ $users->filter(function($user) { 
                        return $user->attendanceRecords->isEmpty(); 
                    })->count() }}</div>
                    <div class="stat-label">Inactive Interns</div>
                </div>
            </div>

            <!-- Interns Table -->
            <div class="glass-card p-8">
                <h3 class="text-xl font-semibold mb-6 neon-text">Interns List</h3>

                <div class="overflow-x-auto">
                    <table class="cyber-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>REGISTERED</th>
                                <th>LAST ATTENDANCE</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                     <td class="font-mono">{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="font-semibold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($user->attendanceRecords->isNotEmpty())
                                            {{ $user->attendanceRecords->first()->created_at->format('M d, Y') }}
                                        @else
                                            <span class="text-gray-500">Never</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->attendanceRecords->isNotEmpty())
                                            <span class="status-badge present">Active</span>
                                        @else
                                            <span class="status-badge absent">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="text-cyan-400 hover:text-cyan-300 transition-colors">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-400">
                                        No interns found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>