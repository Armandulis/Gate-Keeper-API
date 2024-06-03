<?php

namespace App\Entity;

use App\Repository\TravelRepository;
use Carbon\Carbon;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity( repositoryClass: TravelRepository::class )]
class Travel implements EntityInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\ManyToOne( inversedBy: 'travels' )]
  #[ORM\JoinColumn( nullable: false )]
  private ?Character $characterEntity = null;

  #[ORM\ManyToOne]
  #[ORM\JoinColumn( nullable: false )]
  private ?Zone $zone = null;

  #[ORM\Column( length: 255, nullable: true )]
  private ?string $status = null;

  #[ORM\Column( type: Types::TIME_MUTABLE )]
  private ?Carbon $startTime = null;

  #[ORM\Column( type: Types::TIME_MUTABLE )]
  private ?Carbon $endTime = null;

  public function getId() : ?int
  {
    return $this->id;
  }

  public function getCharacterEntity() : ?Character
  {
    return $this->characterEntity;
  }

  public function setCharacterEntity( ?Character $characterEntity ) : static
  {
    $this->characterEntity = $characterEntity;

    return $this;
  }

  public function getZone() : ?Zone
  {
    return $this->zone;
  }

  public function setZone( ?Zone $zone ) : static
  {
    $this->zone = $zone;

    return $this;
  }

  public function getStatus() : ?string
  {
    return $this->status;
  }

  public function setStatus( ?string $status ) : static
  {
    $this->status = $status;

    return $this;
  }

  public function getStartTime() : ?Carbon
  {
    return $this->startTime;
  }

  public function setStartTime( Carbon $startTime ) : static
  {
    $this->startTime = $startTime;

    return $this;
  }

  public function getEndTime() : ?Carbon
  {
    return $this->endTime;
  }

  public function setEndTime( Carbon $endTime ) : static
  {
    $this->endTime = $endTime;

    return $this;
  }

  /**
   * Returns entity data as array
   * @return array<string, int|string|bool>
   */
  public function dataToArray() : array
  {
    return [];
  }
}
