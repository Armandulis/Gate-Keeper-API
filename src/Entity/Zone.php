<?php

namespace App\Entity;

use App\Repository\ZoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity( repositoryClass: ZoneRepository::class )]
class Zone implements EntityInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column( length: 255 )]
  private ?string $name = null;

  #[ORM\Column( length: 5000 )]
  private ?string $description = null;

  #[ORM\Column]
  private ?float $travelTime = null;

  #[ORM\Column]
  private int $level;

  public function getId() : ?int
  {
    return $this->id;
  }

  public function getName() : ?string
  {
    return $this->name;
  }

  public function setName( string $name ) : static
  {
    $this->name = $name;

    return $this;
  }

  public function getLevel() : ?int
  {
    return $this->name;
  }

  public function setLevel( int $name ) : static
  {
    $this->name = $name;

    return $this;
  }

  public function getDescription() : ?string
  {
    return $this->description;
  }

  public function setDescription( string $description ) : static
  {
    $this->description = $description;

    return $this;
  }

  public function getTravelTime() : ?float
  {
    return $this->travelTime;
  }

  public function setTravelTime( float $travelTime ) : static
  {
    $this->travelTime = $travelTime;

    return $this;
  }

  /**
   * Returns entity data as array
   * @return array<string, int|string|bool>
   */
  public function dataToArray() : array
  {
    return [
      'id' => $this->getId(),
      'name' => $this->getName(),
      'description' => $this->getDescription(),
      'travelTime' => $this->getTravelTime(),
      'level' => $this->getLevel(),
    ];
  }
}
