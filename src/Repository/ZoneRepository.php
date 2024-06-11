<?php

namespace App\Repository;

use App\Entity\Zone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ZoneRepository
 */
class ZoneRepository extends BaseRepository
{
  /**
   * ZoneRepository constructor
   * @param ManagerRegistry $registry
   */
  public function __construct( ManagerRegistry $registry )
  {
    parent::__construct( $registry, Zone::class );
  }

  /**
   * Find zones in level range
   * @param int $minLevel The minimum level of the zones
   * @param int $maxLevel The maximum level of the zones
   * @return array An array of Zone objects matching the level range query
   */
  public function findZonesInLevelRange( int $minLevel, int $maxLevel ) : array
  {
    return $this->createQueryBuilder( 'z' )->where( 'z.level >= :min' )->andWhere( 'z.level <= :max' )->setParameters( [
        'min' => $minLevel,
        'max' => $maxLevel,
      ] )->getQuery()->getResult();
  }
}
