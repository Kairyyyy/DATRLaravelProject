<aside class="w-64 min-h-screen flex flex-col" style="background: rgba(5, 5, 10, 0.95); backdrop-filter: blur(10px); border-right: 1px solid rgba(0, 243, 255, 0.2); position: fixed; left: 0; top: 0; height: 100vh; z-index: 40;">
    <div class="p-6 flex-grow overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: rgba(0, 243, 255, 0.2) transparent;">
        <!-- MISOUT Logo/Header -->
        <div class="mb-8 text-center">
            <div class="w-24 h-24 mx-auto mb-3 rounded-full bg-gradient-to-r from-cyan-500 to-purple-600 p-1 flex items-center justify-center">
                <div class="w-full h-full rounded-full bg-gray-900 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/misout-logo.png') }}" alt="ADMIN" class="w-full h-full object-cover">
                </div>
            </div>
            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">ADMIN</h2>
            <div class="w-12 h-1 mx-auto mt-2 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full"></div>
        </div>     
        
        <nav class="space-y-2 mt-4">
            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-cyan-500 to-purple-600 text-white shadow-lg shadow-cyan-500/25' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>

            <!-- Interns Link -->
            <a href="{{ route('admin.interns') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.interns') ? 'bg-gradient-to-r from-cyan-500 to-purple-600 text-white shadow-lg shadow-cyan-500/25' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Interns
            </a>

            <!-- DATR Link -->
            <a href="{{ route('admin.datr') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.datr') ? 'bg-gradient-to-r from-cyan-500 to-purple-600 text-white shadow-lg shadow-cyan-500/25' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                DATR
            </a>

            <!-- Admins Link (NEW) -->
            <a href="{{ route('admin.admins') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.admins') ? 'bg-gradient-to-r from-cyan-500 to-purple-600 text-white shadow-lg shadow-cyan-500/25' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Admins
            </a>
        </nav>
    </div>

    <!-- Weather Widget -->
    <x-weather-widget />
    
    <!-- Footer in sidebar -->
    <div class="p-3 border-t border-gray-800">
        <div class="text-xs text-center text-gray-500">
            <p>Admin Panel v1.0</p>
            <p class="mt-1">&copy; {{ date('Y') }} MISOUT</p>
        </div>
    </div>
</aside>