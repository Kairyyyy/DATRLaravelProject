<x-admin-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @php
                    $totalAdmins = App\Models\Admin::count();
                    $newToday = App\Models\Admin::whereDate('created_at', now()->toDateString())->count();
                    $newThisMonth = App\Models\Admin::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->count();
                @endphp

                <div class="stat-card">
                    <div class="stat-value">{{ $totalAdmins }}</div>
                    <div class="stat-label">Total Admins</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">{{ $newToday }}</div>
                    <div class="stat-label">New Today</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">{{ $newThisMonth }}</div>
                    <div class="stat-label">This Month</div>
                </div>
            </div>

            <!-- Admins Table -->
            <div class="glass-card p-8">
                <h3 class="text-xl font-semibold mb-6 neon-text">Admin List</h3>

                <div class="overflow-x-auto">
                    <table class="cyber-table">
                        <thead>
                            <tr>
                                <th>ADMIN ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>REGISTERED</th>
                                <th>LAST UPDATED</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td class="font-mono">{{ str_pad($admin->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="font-semibold">{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->created_at->format('M d, Y') }}</td>
                                    <td>{{ $admin->updated_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($admin->email_verified_at)
                                            <span class="status-badge present">Verified</span>
                                        @else
                                            <span class="status-badge absent">Unverified</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.admins.show', $admin) }}" class="text-cyan-400 hover:text-cyan-300 transition-colors">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-400">
                                        No admins found.
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