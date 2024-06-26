<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'location' => [
                'name' => $this->resource['name'],
                'country' => $this->resource['sys']['country'],
                'coordinates' => [
                    'latitude' => $this->resource['coord']['lat'],
                    'longitude' => $this->resource['coord']['lon'],
                ],
            ],
            'weather' => [
                'main' => $this->resource['weather'][0]['main'],
                'description' => $this->resource['weather'][0]['description'],
                'icon' => $this->resource['weather'][0]['icon'],
                'temperature' => $this->resource['main']['temp'],
                'feels_like' => $this->resource['main']['feels_like'],
                'temp_min' => $this->resource['main']['temp_min'],
                'temp_max' => $this->resource['main']['temp_max'],
                'pressure' => $this->resource['main']['pressure'],
                'humidity' => $this->resource['main']['humidity'],
                'visibility' => $this->resource['visibility'],
                'wind' => [
                    'speed' => $this->resource['wind']['speed'],
                    'deg' => $this->resource['wind']['deg'],
                    'gust' => $this->resource['wind']['gust'] ?? null,
                ],
                'clouds' => $this->resource['clouds']['all'],
            ],
            'sunrise' => date('H:i:s', $this->resource['sys']['sunrise']),
            'sunset' => date('H:i:s', $this->resource['sys']['sunset']),
        ];
    }
}
