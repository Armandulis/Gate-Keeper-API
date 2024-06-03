<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CharacterRepository
 */
class CharacterRepository extends BaseRepository
{
  /**
   * CharacterRepository constructor
   * @param ManagerRegistry $registry
   */
  public function __construct( ManagerRegistry $registry )
  {
    parent::__construct( $registry, Character::class );
  }
}
