<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $locationService;
    public function __construct(LocationService $locationService) {
        $this->locationService = $locationService;
    }

    public function index(Request $request)
    {
        $queryParams = $request->all();
        return $this->locationService->getLocation($queryParams);
    }
}
