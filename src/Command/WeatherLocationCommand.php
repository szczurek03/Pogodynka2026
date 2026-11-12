<?php

namespace App\Command;

use App\Repository\PlaceRepository;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:location',
    description: 'Add a short description for your command',
)]
class WeatherLocationCommand{
    public function __construct(private WeatherUtil $util,private PlaceRepository $placeRepository)
    {
    }
    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Location ID')] int $id,
    ): int {
        $place = $this->placeRepository->find($id);
        $measurements = $this->util->getWeatherForPlace($place);

        $io->writeln(sprintf('Location: %s', $place->getLocality()));
        $io->table(
            ['Date', 'Temperature', 'Wind Speed', 'Humidity', 'Pressure'],
            array_map(fn($m) => [
                $m->getDate()->format('Y-m-d'),
                $m->getTemperature() . ' C',
                $m->getWindSpeed() . ' km/h',
                $m->getHumidity() . ' %',
                $m->getAtmosphericPressure() . ' hPa',
            ], $measurements)
        );

        return Command::SUCCESS;
    }
}
