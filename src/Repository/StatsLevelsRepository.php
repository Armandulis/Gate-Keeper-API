<?php

namespace App\Repository;

use App\Entity\StatsLevels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class StatsLevelsRepository
 */
class StatsLevelsRepository extends BaseRepository
{
  /**
   * StatsLevelsRepository constructor
   * @param ManagerRegistry $registry
   */
  public function __construct( ManagerRegistry $registry )
  {
    parent::__construct( $registry, StatsLevels::class );
  }
}
