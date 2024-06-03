<?php

namespace App\Entity;

use App\Repository\BaseStatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity( repositoryClass: BaseStatsRepository::class )]
class BaseStats implements EntityInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column]
  private float $health = 10;

  #[ORM\Column]
  private float $defence = 0;

  #[ORM\Column]
  private float $mana = 10;

  #[ORM\Column]
  private float $damage = 1;

  #[ORM\Column]
  private float $luck = 0.1;

  #[ORM\Column]
  private float $criticalDamage = 1.1;

  #[ORM\Column]
  private float $leach = 0;

  #[ORM\Column]
  private float $speed = 1;

  public function getId() : ?int
  {
    return $this->id;
  }

  public function getHealth() : float
  {
    return $this->health;
  }

  public function setHealth( float $health ) : static
  {
    $this->health = $health;

    return $this;
  }

  public function getDefence() : float
  {
    return $this->defence;
  }

  public function setDefence( float $defence ) : static
  {
    $this->defence = $defence;

    return $this;
  }

  public function getMana() : float
  {
    return $this->mana;
  }

  public function setMana( float $mana ) : static
  {
    $this->mana = $mana;

    return $this;
  }

  public function getDamage() : float
  {
    return $this->damage;
  }

  public function setDamage( float $damage ) : static
  {
    $this->damage = $damage;

    return $this;
  }

  public function getLuck() : float
  {
    return $this->luck;
  }

  public function setLuck( float $luck ) : static
  {
    $this->luck = $luck;

    return $this;
  }

  public function getCriticalDamage() : float
  {
    return $this->criticalDamage;
  }

  public function setCriticalDamage( float $criticalDamage ) : static
  {
    $this->criticalDamage = $criticalDamage;

    return $this;
  }

  public function getLeach() : float
  {
    return $this->leach;
  }

  public function setLeach( float $leach ) : static
  {
    $this->leach = $leach;

    return $this;
  }

  public function getSpeed() : float
  {
    return $this->speed;
  }

  public function setSpeed( float $speed ) : static
  {
    $this->speed = $speed;

    return $this;
  }

  public function getPerception() : float
  {
    return $this->perception;
  }

  public function setPerception( float $perception ) : static
  {
    $this->perception = $perception;

    return $this;
  }

  /**
   * Returns entity data as array
   * @return array<string, int|string|bool>
   */
  public function dataToArray() : array
  {
    return [
      'id' => $this->id,
      'health' => $this->health,
      'defence' => $this->defence,
      'mana' => $this->mana,
      'damage' => $this->damage,
      'luck' => $this->luck,
      'criticalDamage' => $this->criticalDamage,
      'leach' => $this->leach,
      'speed' => $this->speed,
      'perception' => $this->perception,
    ];
  }
}
