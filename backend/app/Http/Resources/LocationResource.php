<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'results' => $this->transformResults($this['results']),
            'context' => [
                'geo_bounds' => [
                    'circle' => [
                        'center' => [
                            'latitude' => $this['context']['geo_bounds']['circle']['center']['latitude'],
                            'longitude' => $this['context']['geo_bounds']['circle']['center']['longitude'],
                        ],
                        'radius' => $this['context']['geo_bounds']['circle']['radius'],
                    ],
                ],
            ],
        ];
    }

    protected function transformResults($results)
    {
        return array_map(function ($result) {
            return [
                'fsq_id' => $result['fsq_id'] ?? null,
                'categories' => [
                    [
                        'id' => $result['categories'][0]['id'] ?? null,
                        'name' => $result['categories'][0]['name'] ?? null,
                        'short_name' => $result['categories'][0]['short_name'] ?? null,
                        'plural_name' => $result['categories'][0]['plural_name'] ?? null,
                        
                    ],
                ],
                'chains' => $result['chains'] ?? [],
                'closed_bucket' => $result['closed_bucket'] ?? null,
                'distance' => $result['distance'] ?? null,
                'geocodes' => [
                    'main' => [
                        'latitude' => $result['geocodes']['main']['latitude'] ?? null,
                        'longitude' => $result['geocodes']['main']['longitude'] ?? null,
                    ],
                    'roof' => [
                        'latitude' => $result['geocodes']['roof']['latitude'] ?? null,
                        'longitude' => $result['geocodes']['roof']['longitude'] ?? null,
                    ],
                ],
                'link' => $result['link'] ?? null,
                'location' => [
                    'name' => $result['name'] ?? null,
                    'country' => $result['location']['country'] ?? null,
                    'coordinates' => [
                        'latitude' => $result['geocodes']['main']['latitude'] ?? null,
                        'longitude' => $result['geocodes']['main']['longitude'] ?? null,
                    ],
                    'address' => $result['location']['address'] ?? null,
                    'address_extended' => $result['location']['address_extended'] ?? null,
                    'formatted_address' => $result['location']['formatted_address'] ?? null,
                    'locality' => $result['location']['locality'] ?? null,
                    'postcode' => $result['location']['postcode'] ?? null,
                    'region' => $result['location']['region'] ?? null,
                    'icon' => [
                            'prefix' => $result['categories'][0]['icon']['prefix'] ?? null,
                            'suffix' => $result['categories'][0]['icon']['suffix'] ?? null,
                        ],
                ],
                'related_places' => $this->transformRelatedPlaces($result['related_places'] ?? []),
                'timezone' => $result['timezone'] ?? null,
            ];
        }, $results);
    }

    protected function transformRelatedPlaces(array $relatedPlaces): array
    {
        return array_map(function ($place) {
            return [
                'fsq_id' => $place['fsq_id'] ?? null,
                'categories' => [
                    [
                        'id' => $place['categories'][0]['id'] ?? null,
                        'name' => $place['categories'][0]['name'] ?? null,
                        'short_name' => $place['categories'][0]['short_name'] ?? null,
                        'plural_name' => $place['categories'][0]['plural_name'] ?? null,
                        'icon' => [
                            'prefix' => $place['categories'][0]['icon']['prefix'] ?? null,
                            'suffix' => $place['categories'][0]['icon']['suffix'] ?? null,
                        ],
                    ],
                ],
                'name' => $place['name'] ?? null,
            ];
        }, $relatedPlaces);
    }
}
