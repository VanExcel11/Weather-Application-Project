<?php

namespace App\Services;

use App\Http\Resources\LocationResource;
use Illuminate\Support\Facades\Http;

/**
 * Class LocationService.
 */
class LocationService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FORE_SQUARE_API_TOKEN');
    }
    public function getLocation(array $queryParams = [])
    {
        // set default parameters for the api call
        // set to tokyo longitude and latitude
        $defaultParams = [
            'll' => '35.6895,139.6917',
            'limit' => 50,
        ];

        $params = array_merge($defaultParams, $queryParams);

        $response = Http::withHeaders([
            'Authorization' =>  $this->apiKey,
            'Accept' => 'application/json',
        ])->get('https://api.foursquare.com/v3/places/search', $params);

        if ($response->successful()) {
            $location = $response->json();

            // Transfer the json response to the LocationResource 
            return new LocationResource(collect($location));
        }

        return [
            'error' => $response->status(),
            'message' => $response->body(),
        ];
    }
}
