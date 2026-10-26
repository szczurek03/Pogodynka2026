<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'measurements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?place $place = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column]
    private ?int $temperature = null;

    #[ORM\Column]
    private ?int $Wind_Speed = null;

    #[ORM\Column]
    private ?int $humidity = null;

    #[ORM\Column]
    private ?int $Atmospheric_pressure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?place
    {
        return $this->place;
    }

    public function setPlace(?place $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getWindSpeed(): ?int
    {
        return $this->Wind_Speed;
    }

    public function setWindSpeed(int $Wind_Speed): static
    {
        $this->Wind_Speed = $Wind_Speed;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): static
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getAtmosphericPressure(): ?int
    {
        return $this->Atmospheric_pressure;
    }

    public function setAtmosphericPressure(int $Atmospheric_pressure): static
    {
        $this->Atmospheric_pressure = $Atmospheric_pressure;

        return $this;
    }
}
