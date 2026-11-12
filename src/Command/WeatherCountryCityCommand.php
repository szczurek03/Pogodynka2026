<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:country_city',
    description: 'Add a short description for your command',
)]
class WeatherCountryCityCommand{

    public function __construct(private WeatherUtil $util){
    }
    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Country Code')] string $country,
        #[Argument('City Name')] string $city,
    ): int {

        $measurements = $this->util->getWeatherForCountryAndCity($country, $city);

        $io->writeln(sprintf('Location: %s, %s', $city, $country ));
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
