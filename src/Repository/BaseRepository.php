<?php

namespace App\Repository;

use App\Entity\EntityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class BaseRepository
 */
abstract class BaseRepository extends ServiceEntityRepository
{
  /**
   * Insert a new entity into the database.
   * @param EntityInterface $entity The entity to insert.
   * @return void
   */
  public function insert( EntityInterface $entity ) : void
  {
    $this->getEntityManager()->persist( $entity );
    $this->getEntityManager()->flush();
  }
}
