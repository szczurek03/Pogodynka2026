<?php

namespace App\Service;

use App\Entity\Place;
use App\Entity\Measurement;
use App\Repository\MeasurementRepository;
use App\Repository\PlaceRepository;


class WeatherUtil
{



    public function __construct(private PlaceRepository $placeRepository,  private MeasurementRepository $measurementRepository)
    {
    }

    public function getWeatherForPlace(Place $place): array
    {
        return $this->measurementRepository->findByPlace($place);
    }
    public function getWeatherForCountryAndCity(string $countryCode,string $city): array
    {
        $place = $this->placeRepository->findOneBy(['Country'=>$countryCode,'Locality'=>$city]);

        return $this->getWeatherForPlace($place);
    }
}
