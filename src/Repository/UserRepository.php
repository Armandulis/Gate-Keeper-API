<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository
{
  /**
   * UserRepository constructor
   * @param ManagerRegistry $registry
   */
  public function __construct( ManagerRegistry $registry )
  {
    parent::__construct( $registry, User::class );
  }
}
