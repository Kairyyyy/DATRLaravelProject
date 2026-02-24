<aside class="w-64 min-h-screen flex flex-col" style="background: rgba(5, 5, 10, 0.95); backdrop-filter: blur(10px); border-right: 1px solid rgba(0, 243, 255, 0.2);">
    <div class="p-6 flex-grow">
        <!-- MISOUT Logo/Header -->
        <div class="mb-8 text-center">
            <div class="w-24 h-24 mx-auto mb-3 rounded-full bg-gradient-to-r from-cyan-500 to-purple-600 p-1 flex items-center justify-center">
                <div class="w-full h-full rounded-full bg-gray-900 flex items-center justify-center overflow-hidden">
                    <!-- Image logo - replace with your actual image path -->
                    <img src="{{ asset('images/misout-logo.png') }}" alt="MISOUT" class="w-full h-full object-cover">
                    <!-- Fallback text if image doesn't load -->
                  
                </div>
            </div>
            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">MISOUT</h2>
            <div class="w-12 h-1 mx-auto mt-2 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full"></div>
        </div>
        
        <nav class="space-y-2">
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-cyan-500 to-purple-600 text-white shadow-lg shadow-cyan-500/25' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>

            <!-- Attendance Link -->
            <a href="{{ route('attendance.index') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('attendance*') ? 'bg-gradient-to-r from-cyan-500 to-purple-600 text-white shadow-lg shadow-cyan-500/25' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Attendance
            </a>
        </nav>
    </div>

    <!-- Weather Widget -->
    <x-weather-widget />
    
    <!-- Optional: Footer in sidebar -->
    <div class="p-6 border-t border-gray-800">
        <div class="text-xs text-center text-gray-500">
            <p>MISOUT v1.0</p>
            <p class="mt-1">&copy; {{ date('Y') }}</p>
        </div>
    </div>
</aside>