<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $weatherService;

    public function __construct(WeatherService $weatherService) {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $queryParams = $request->all();
        return $this->weatherService->getWeather($queryParams);
    }
}
