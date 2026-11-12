<?php

namespace App\Service;

use App\Entity\Place;
use App\Entity\Measurement;
use App\Repository\MeasurementRepository;
use App\Repository\PlaceRepository;


class WeatherUtil
{

    public function __construct(private PlaceRepository $placeRepository)
    {
    }

    public function getWeatherForPlace(Place $place): array
    {
        return $place->getMeasurements()->toArray();
    }
    public function getWeatherForCountryAndCity(string $countryCode,string $city): array
    {
        $place = $this->placeRepository->findOneBy(['Country'=>$countryCode,'Locality'=>$city]);

        return $this->getWeatherForPlace($place);
    }
}
