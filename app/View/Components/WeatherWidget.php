<?php

namespace App\View\Components;

use App\Services\WeatherService;
use Illuminate\View\Component;

class WeatherWidget extends Component
{
    public $weather;
    
    /**
     * Create a new component instance.
     */
    public function __construct(WeatherService $weatherService)
    {
        // Manila coordinates (you can make this dynamic later)
        $this->weather = $weatherService->getWeather(14.5995, 120.9842);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.weather-widget');
    }
}