<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert-futuristic success mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-futuristic error mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Update Profile Information -->
            <div class="glass-card p-8 mb-6">
                <h3 class="text-xl font-semibold mb-6 neon-text">Profile Information</h3>
                
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-300 mb-2">Name</label>
                            <input type="text" name="name" id="name" 
                                   value="{{ old('name', Auth::user()->name) }}"
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-white"
                                   required>
                            @error('name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" id="email" 
                                   value="{{ old('email', Auth::user()->email) }}"
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-white"
                                   required>
                            @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="btn-futuristic">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Password -->
            <div class="glass-card p-8 mb-6">
                <h3 class="text-xl font-semibold mb-6 neon-text">Change Password</h3>
                
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Current Password -->
                        <div class="mb-4">
                            <label for="current_password" class="block text-gray-300 mb-2">Current Password</label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-white">
                            @error('current_password')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="new_password" class="block text-gray-300 mb-2">New Password</label>
                            <input type="password" name="new_password" id="new_password" 
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-white">
                            @error('new_password')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-4 md:col-span-2">
                            <label for="new_password_confirmation" class="block text-gray-300 mb-2">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-white">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="btn-futuristic">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div class="glass-card p-8 border-red-500/30">
                <h3 class="text-xl font-semibold mb-4 text-red-400">Delete Account</h3>
                <p class="text-gray-400 mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    
                    <div class="mb-4">
                        <label for="password" class="block text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" id="password" 
                               class="w-full px-4 py-2 bg-gray-800 border border-red-500/30 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 text-white"
                               required>
                    </div>

                    <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>