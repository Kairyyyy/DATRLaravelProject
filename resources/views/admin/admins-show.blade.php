<x-admin-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.admins') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Admins
                </a>
            </div>

            <!-- Admin Details Card -->
            <div class="glass-card p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold neon-text">Admin Details</h3>
                    <span class="font-mono text-sm text-gray-400">ID: {{ str_pad($admin->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Name</label>
                        <p class="text-white text-lg">{{ $admin->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Email</label>
                        <p class="text-white text-lg">{{ $admin->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Registered</label>
                        <p class="text-white">{{ $admin->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Last Updated</label>
                        <p class="text-white">{{ $admin->updated_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-gray-400 text-sm mb-1">Email Verified</label>
                        <div class="mt-1">
                            @if($admin->email_verified_at)
                                <span class="status-badge present">Verified on {{ $admin->email_verified_at->format('M d, Y') }}</span>
                            @else
                                <span class="status-badge absent">Not Verified</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>