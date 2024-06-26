<?php

namespace App\Services;

use App\Http\Resources\WeatherResource;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPEN_WEATHER_API_TOKEN');
    }

    public function getWeather(array $queryParams = [])
    {
        // set default parameters for the api call
        // set to tokyo
        $defaultParams = [
            'q' => 'Tokyo',
            'appid' => $this->apiKey,
        ];

        $params = array_merge($defaultParams, $queryParams);

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', $params);

        if ($response->successful()) {
            $weather = $response->json();

            // Transfer the json response to the WeatherResource
            return new WeatherResource(collect($weather));
        }

        return [
            'error' => $response->status(),
            'message' => $response->body(),
        ];
    }
}
