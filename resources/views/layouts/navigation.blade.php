<nav x-data="{ open: false }" class="w-full" style="background: rgba(10, 10, 20, 0.95); backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); z-index: 1000;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side - Page Indicator -->
            <div class="flex items-center">
                <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">
                    @if(request()->routeIs('dashboard'))
                        DASHBOARD
                    @elseif(request()->routeIs('attendance*'))
                        ATTENDANCE
                    @elseif(request()->routeIs('profile.edit'))
                        PROFILE
                    @else
                        MISOUT
                    @endif
                </h2>
            </div>
            
            <!-- Right side - Settings Dropdown with Profile Logo -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full bg-gradient-to-r from-cyan-500 to-purple-600 text-white hover:shadow-lg hover:shadow-cyan-500/25 transition-all duration-300 focus:outline-none">
                            <!-- Profile Logo/Circle -->
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </div>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>{{ __('Log Out') }}</span>
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for mobile -->
            <div class="flex items-center sm:hidden ml-4">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-cyan-400 hover:bg-cyan-500/10 focus:outline-none focus:bg-cyan-500/10 focus:text-cyan-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900/95 backdrop-blur-lg border-t border-gray-800">
        <div class="pt-4 pb-1">
            <div class="px-4">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-base text-cyan-400">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <!-- Mobile Page Indicator -->
                <div class="py-2 mb-2">
                    <h2 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">
                        @if(request()->routeIs('dashboard'))
                            DASHBOARD
                        @elseif(request()->routeIs('attendance*'))
                            ATTENDANCE
                        @elseif(request()->routeIs('profile.edit'))
                            PROFILE
                        @else
                            MISOUT
                        @endif
                    </h2>
                </div>
                
                <!-- Mobile Dashboard Link -->
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-base text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-colors duration-300">
                    Dashboard
                </a>
                
                <!-- Mobile Attendance Link -->
                <a href="{{ route('attendance.index') }}" class="block px-4 py-2 text-base text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-colors duration-300">
                    Attendance
                </a>

                <!-- Mobile Profile Link -->
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-colors duration-300">
                    Profile
                </a>

                <div class="border-t border-gray-800 my-2"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-gray-300 hover:text-cyan-400 hover:bg-cyan-500/10">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>{{ __('Log Out') }}</span>
                        </div>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>