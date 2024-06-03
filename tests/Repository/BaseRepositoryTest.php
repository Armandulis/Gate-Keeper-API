<?php

namespace App\Tests\Repository;

use App\Entity\EntityInterface;
use App\Repository\BaseRepository;
use App\Tests\Utils\TestCase;
use Doctrine\ORM\EntityManager;

/**
 * Class BaseRepositoryTest
 */
final class BaseRepositoryTest extends TestCase
{
  private BaseRepository $baseRepository;

  private EntityManager $entityManager;

  protected function setUp() : void
  {
    parent::setUp();

    // Set up base repository, partially mock it
    // Fun fact: you shouldn't partially mock your classes. If you do (or must),
    // then it means that your class probably doesn't follow SOLID first rule: Single responsibility
    $this->baseRepository = $this->getMockBuilder( BaseRepository::class )->disableOriginalConstructor()->onlyMethods( [ 'getEntityManager' ] )->getMock();

    $this->entityManager = $this->createMock( EntityManager::class );
    $this->baseRepository->method( 'getEntityManager' )->willReturn( $this->entityManager );
  }

  public function testInsert() : void
  {
    // Given we have entity
    $entity = $this->createMock( EntityInterface::class );

    // Then we expect to persist and flush
    $this->entityManager->expects( self::once() )->method( 'persist' )->with( $entity );
    $this->entityManager->expects( self::once() )->method( 'flush' );

    // When we call insert
    $this->baseRepository->insert( $entity );
  }
}
