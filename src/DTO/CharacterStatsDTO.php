<?php

namespace App\DTO;

class CharacterStatsDTO implements DTOInterface
{
  public float $health = 0;
  public float $defence = 0;
  public float $mana = 0;
  public float $damage = 0;
  public float $luck = 0;
  public float $criticalDamage = 0;
  public float $leach = 0;
  public float $speed = 0;


  public function dataToArray() : array
  {
    return [];
  }
}