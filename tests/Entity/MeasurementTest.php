<?php

namespace App\Tests\Entity;
use App\Entity\Measurement;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class MeasurementTest extends TestCase
{
    public static function dataGetFahrenheit(): array
    {
        return [
            ['0', '32'],
            ['-100', '-148'],
            ['100', '212'],
            ['0.5', '32.9'],
            ['-0.5', '31.1'],
            ['12.5', '54.5'],
            ['-10.5', '13.1'],
            ['25.5', '77.9'],
            ['-17.5', '0.5'],
            ['17.5', '63.5'],
        ];
    }

    #[DataProvider('dataGetFahrenheit')]
    public function testGetFahrenheit(string $celsius, string $expectedFahrenheit): void
    {
        $measurement = new Measurement();
        $measurement->setTemperature((float) $celsius);

        $this->assertEquals($expectedFahrenheit, $measurement->getFahrenheit());

    }
}
