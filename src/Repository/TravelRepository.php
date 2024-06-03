<?php

namespace App\Repository;

use App\Entity\Travel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TravelRepository
 */
class TravelRepository extends BaseRepository
{
  /**
   * TravelRepository constructor
   * @param ManagerRegistry $registry
   */
  public function __construct( ManagerRegistry $registry )
  {
    parent::__construct( $registry, Travel::class );
  }
}
