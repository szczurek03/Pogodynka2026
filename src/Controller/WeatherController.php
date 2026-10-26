<?php

namespace App\Controller;

use App\Entity\Place;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{locality}/{country}', name: 'app_weather')]

    public function locality(#[MapEntity(mapping: ['locality' => 'Locality', 'country' => 'Country'])]
                             Place $place, MeasurementRepository $repository): Response
    {

        $measurements = $repository->findByPlace($place);

        return $this->render('weather/locality.html.twig', [
            'place' => $place,
            'measurements' => $measurements,
        ]);
    }
}

