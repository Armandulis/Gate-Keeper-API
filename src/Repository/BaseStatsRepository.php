<?php

namespace App\Repository;

use App\Entity\BaseStats;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class BaseStatsRepository
 */
class BaseStatsRepository extends BaseRepository
{
  /**
   * BaseStatsRepository constructor
   * @param ManagerRegistry $registry
   */
  public function __construct( ManagerRegistry $registry )
  {
    parent::__construct( $registry, BaseStats::class );
  }
}
