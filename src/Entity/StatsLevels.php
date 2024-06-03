<?php

namespace App\Entity;

use App\Repository\StatsLevelsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity( repositoryClass: StatsLevelsRepository::class )]
class StatsLevels implements EntityInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private int $level = 1;

  #[ORM\Column]
  private float $experience = 0;

  #[ORM\Column]
  private int $healthLevel = 1;

  #[ORM\Column]
  private int $defenceLevel = 1;

  #[ORM\Column]
  private int $manaLevel = 1;

  #[ORM\Column]
  private int $damageLevel = 1;

  #[ORM\Column]
  private int $luckLevel = 1;

  #[ORM\Column]
  private int $criticalDamageLevel = 1;

  #[ORM\Column]
  private int $leachLevel = 1;

  #[ORM\Column]
  private int $speedLevel = 1;

  #[ORM\Column]
  private int $perceptionLevel = 1;

  public function getId() : ?int
  {
    return $this->id;
  }

  public function getLevel() : int
  {
    return $this->level;
  }

  public function setLevel( int $level ) : static
  {
    $this->level = $level;

    return $this;
  }

  public function getExperience() : float
  {
    return $this->experience;
  }

  public function setExperience( float $experience ) : static
  {
    $this->experience = $experience;

    return $this;
  }

  public function getHealthLevel() : int
  {
    return $this->healthLevel;
  }

  public function setHealthLevel( int $healthLevel ) : static
  {
    $this->healthLevel = $healthLevel;

    return $this;
  }

  public function getDefenceLevel() : int
  {
    return $this->defenceLevel;
  }

  public function setDefenceLevel( int $defenceLevel ) : static
  {
    $this->defenceLevel = $defenceLevel;

    return $this;
  }

  public function getManaLevel() : int
  {
    return $this->manaLevel;
  }

  public function setManaLevel( int $manaLevel ) : static
  {
    $this->manaLevel = $manaLevel;

    return $this;
  }

  public function getDamageLevel() : int
  {
    return $this->damageLevel;
  }

  public function setDamageLevel( int $damageLevel ) : static
  {
    $this->damageLevel = $damageLevel;

    return $this;
  }

  public function getLuckLevel() : int
  {
    return $this->luckLevel;
  }

  public function setLuckLevel( int $luckLevel ) : static
  {
    $this->luckLevel = $luckLevel;

    return $this;
  }

  public function getCriticalDamageLevel() : int
  {
    return $this->criticalDamageLevel;
  }

  public function setCriticalDamageLevel( int $criticalDamageLevel ) : static
  {
    $this->criticalDamageLevel = $criticalDamageLevel;

    return $this;
  }

  public function getLeachLevel() : int
  {
    return $this->leachLevel;
  }

  public function setLeachLevel( int $leachLevel ) : static
  {
    $this->leachLevel = $leachLevel;

    return $this;
  }

  public function getSpeedLevel() : int
  {
    return $this->speedLevel;
  }

  public function setSpeedLevel( int $speedLevel ) : static
  {
    $this->speedLevel = $speedLevel;

    return $this;
  }

  public function getPerceptionLevel() : int
  {
    return $this->perceptionLevel;
  }

  public function setPerceptionLevel( int $perceptionLevel ) : static
  {
    $this->perceptionLevel = $perceptionLevel;

    return $this;
  }

  public function getAvailablePoints() : int
  {
    return 0;
  }

  /**
   * Returns entity data as array
   * @return array<string, int|string|bool>
   */
  public function dataToArray() : array
  {
    return [
      'id' => $this->id,
      'level' => $this->level,
      'experience' => $this->experience,
      'healthLevel' => $this->healthLevel,
      'defenceLevel' => $this->defenceLevel,
      'manaLevel' => $this->manaLevel,
      'damageLevel' => $this->damageLevel,
      'luckLevel' => $this->luckLevel,
      'criticalDamageLevel' => $this->criticalDamageLevel,
      'leachLevel' => $this->leachLevel,
      'speedLevel' => $this->speedLevel,
      'perceptionLevel' => $this->perceptionLevel,
    ];
  }
}
