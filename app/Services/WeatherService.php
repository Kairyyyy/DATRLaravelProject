<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $baseUrl = 'https://api.open-meteo.com/v1';
    
    /**
     * Get current weather for a location (latitude/longitude)
     */
    public function getWeather($lat = 14.5995, $lon = 120.9842) // Default to Manila
    {
        $cacheKey = 'weather_' . $lat . '_' . $lon;
        
        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($lat, $lon) {
            try {
                $response = Http::get($this->baseUrl . '/forecast', [
                    'latitude' => $lat,
                    'longitude' => $lon,
                    'current_weather' => 'true',
                    'timezone' => 'Asia/Manila',
                    'hourly' => 'temperature_2m,relativehumidity_2m,windspeed_10m',
                    'forecast_days' => 1,
                ]);
                
                if ($response->successful()) {
                    $data = $response->json();
                    $current = $data['current_weather'];
                    
                    return [
                        'temperature' => round($current['temperature']),
                        'windspeed' => $current['windspeed'],
                        'winddirection' => $current['winddirection'],
                        'weathercode' => $current['weathercode'],
                        'time' => $current['time'],
                        'description' => $this->getWeatherDescription($current['weathercode']),
                        'humidity' => $data['hourly']['relativehumidity_2m'][0] ?? 70,
                    ];
                }
                
                return $this->getFallbackWeather();
            } catch (\Exception $e) {
                return $this->getFallbackWeather();
            }
        });
    }
    
    /**
     * Convert WMO weather code to description
     */
    protected function getWeatherDescription($code)
    {
        $descriptions = [
            0 => 'Clear sky',
            1 => 'Mainly clear',
            2 => 'Partly cloudy',
            3 => 'Overcast',
            45 => 'Fog',
            48 => 'Rime fog',
            51 => 'Light drizzle',
            53 => 'Moderate drizzle',
            55 => 'Dense drizzle',
            61 => 'Slight rain',
            63 => 'Moderate rain',
            65 => 'Heavy rain',
            71 => 'Slight snow',
            73 => 'Moderate snow',
            75 => 'Heavy snow',
            95 => 'Thunderstorm',
        ];
        
        return $descriptions[$code] ?? 'Unknown';
    }
    
    /**
     * Fallback weather data
     */
    protected function getFallbackWeather()
    {
        return [
            'temperature' => 28,
            'windspeed' => 5,
            'winddirection' => 180,
            'weathercode' => 2,
            'description' => 'Partly cloudy',
            'humidity' => 75,
        ];
    }
}