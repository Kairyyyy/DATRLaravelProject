<div class="mb-6 px-8">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-sm font-semibold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">
            WEATHER
        </h3>
        <div class="text-xs text-gray-400">
            Manila
        </div>
    </div>
    
    <!-- Current Weather -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <div class="text-4xl mr-2">
                @if($weather['weathercode'] <= 1) ☀️
                @elseif($weather['weathercode'] <= 2) ⛅
                @elseif($weather['weathercode'] <= 3) ☁️
                @elseif($weather['weathercode'] <= 48) 🌫️
                @elseif($weather['weathercode'] <= 55) 🌧️
                @elseif($weather['weathercode'] <= 65) 🌧️
                @elseif($weather['weathercode'] <= 75) 🌨️
                @elseif($weather['weathercode'] == 95) ⛈️
                @else ☁️
                @endif
            </div>
            <div>
                <div class="text-2xl font-bold text-cyan-400">{{ $weather['temperature'] }}°C</div>
                <div class="text-xs text-gray-400 capitalize">{{ $weather['description'] }}</div>
            </div>
        </div>
    </div>
    
    <!-- Weather Details -->
    <div class="grid grid-cols-2 gap-2 text-center">
        <div>
            <svg class="w-4 h-4 text-cyan-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
            </svg>
            <div class="text-xs text-gray-400">Humidity</div>
            <div class="text-sm text-white">{{ $weather['humidity'] }}%</div>
        </div>
        <div>
            <svg class="w-4 h-4 text-cyan-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
            <div class="text-xs text-gray-400">Wind</div>
            <div class="text-sm text-white">{{ $weather['windspeed'] }} km/h</div>
        </div>
    </div>
</div>