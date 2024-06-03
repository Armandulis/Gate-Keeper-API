<?php

namespace App\Tests\Provider;

use App\Entity\User;
use App\Exception\NotAuthenticatedException;
use App\Provider\CurrentUserProvider;
use App\Repository\UserRepository;
use App\Tests\Utils\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * Class CurrentUserProviderTest
 */
class CurrentUserProviderTest extends TestCase
{
  private UserRepository&MockObject $userRepository;
  private Security&MockObject $security;

  public function setUp() : void
  {
    // Set up mocks
    $this->userRepository = $this->createMock( UserRepository::class );
    $this->security = $this->createMock( Security::class );

    // Set up provider
    $this->currentUserProvider = new CurrentUserProvider( $this->userRepository, $this->security );
  }

  public function testGetCurrentUser() : void
  {
    // Given user
    $user = new User();
    $user->setEmail( 'email@identifier.com' );

    // Given user is authenticated
    $this->security->method( 'getUser' )->willReturn( $user );

    // Given user exists
    $this->userRepository->method( 'findOneBy' )->with( [ 'email' => 'email@identifier.com' ] )->willReturn( $user );

    // When we call getCurrentUser
    $result = $this->currentUserProvider->getCurrentUser();

    // then we expect to receive correct user
    self::assertEquals( $user, $result );
  }

  public function testGetCurrentUserNotFound() : void
  {
    // Given user
    $user = new User();
    $user->setEmail( 'email@identifier.com' );

    // Given user is authenticated
    $this->security->method( 'getUser' )->willReturn( $user );

    // Given user does not exist
    $this->userRepository->method( 'findOneBy' )->willReturn( null );

    // Then we expect to throw NotAuthenticatedException
    $this->expectException( NotAuthenticatedException::class );

    // When we call getCurrentUser
    $result = $this->currentUserProvider->getCurrentUser();
  }
}
