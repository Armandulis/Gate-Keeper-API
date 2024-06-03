<?php

namespace App\Service;

use App\Entity\BaseStats;
use App\Entity\StatsLevels;
use App\Repository\BaseStatsRepository;
use App\Repository\StatsLevelsRepository;
use InvalidArgumentException;

/**
 * Class StatsLevelsService
 */
class StatsLevelsService
{
  /**
   * StatsLevelsService constructor
   * @param StatsLevelsRepository $statsLevelsRepository
   */
  public function __construct( private readonly StatsLevelsRepository $statsLevelsRepository )
  {
  }

  /**
   * Increases the level of a specific stat in a StatsLevels object.
   * @param StatsLevels $statsLevels The StatsLevels object to modify.
   * @param string $statName The name of the stat to decrease.
   * @throws InvalidArgumentException If an invalid stat name is provided.
   */
  public function levelUpStat( StatsLevels $statsLevels, string $statName ) : void
  {
    switch( $statName )
    {
      case 'health':
        $statsLevels->setHealthLevel( $statsLevels->getHealthLevel() + 1 );
        break;

      case 'defence':
        $statsLevels->setDefenceLevel( $statsLevels->getDefenceLevel() + 1 );
        break;

      case 'mana':
        $statsLevels->setManaLevel( $statsLevels->getManaLevel() + 1 );
        break;

      case 'damage':
        $statsLevels->setDamageLevel( $statsLevels->getDamageLevel() + 1 );
        break;

      case 'luck':
        $statsLevels->setLuckLevel( $statsLevels->getLuckLevel() + 1 );
        break;

      case 'criticalDamage':
        $statsLevels->setCriticalDamageLevel( $statsLevels->getCriticalDamageLevel() + 1 );
        break;

      case 'leach':
        $statsLevels->setLeachLevel( $statsLevels->getLeachLevel() + 1 );
        break;

      case 'speed':
        $statsLevels->setSpeedLevel( $statsLevels->getSpeedLevel() + 1 );
        break;

      case 'perception':
        $statsLevels->setPerceptionLevel( $statsLevels->getPerceptionLevel() + 1 );
        break;

      default:
        throw new InvalidArgumentException( 'Invalid stat name: ' . $statName );
    }

    $this->statsLevelsRepository->insert( $statsLevels );
  }

  /**
   * Decreases the level of a specific stat in a StatsLevels object.
   * @param StatsLevels $statsLevels The StatsLevels object to modify.
   * @param string $statName The name of the stat to decrease.
   * @throws InvalidArgumentException If an invalid stat name is provided.
   */
  public function levelDownStat( StatsLevels $statsLevels, string $statName )
  {
    switch( $statName )
    {
      case 'health':
        $statsLevels->setHealthLevel( $statsLevels->getHealthLevel() - 1 );
        break;

      case 'defence':
        $statsLevels->setDefenceLevel( $statsLevels->getDefenceLevel() - 1 );
        break;

      case 'mana':
        $statsLevels->setManaLevel( $statsLevels->getManaLevel() - 1 );
        break;

      case 'damage':
        $statsLevels->setDamageLevel( $statsLevels->getDamageLevel() - 1 );
        break;

      case 'luck':
        $statsLevels->setLuckLevel( $statsLevels->getLuckLevel() - 1 );
        break;

      case 'criticalDamage':
        $statsLevels->setCriticalDamageLevel( $statsLevels->getCriticalDamageLevel() - 1 );
        break;

      case 'leach':
        $statsLevels->setLeachLevel( $statsLevels->getLeachLevel() - 1 );
        break;

      case 'speed':
        $statsLevels->setSpeedLevel( $statsLevels->getSpeedLevel() - 1 );
        break;

      case 'perception':
        $statsLevels->setPerceptionLevel( $statsLevels->getPerceptionLevel() - 1 );
        break;

      default:
        throw new InvalidArgumentException( 'Invalid stat name: ' . $statName );
    }
  }
}
