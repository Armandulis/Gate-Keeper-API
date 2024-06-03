<?php

namespace App\Tests\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use App\Tests\Utils\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserServiceTest
 */
final class UserServiceTest extends TestCase
{
  private UserPasswordHasherInterface&MockObject $userPasswordHasher;

  private UserRepository&MockObject $userRepository;

  private UserService $userService;

  protected function setUp() : void
  {
    parent::setUp();

    // Set up mocks
    $this->userPasswordHasher = $this->createMock( UserPasswordHasherInterface::class );
    $this->userRepository = $this->createMock( UserRepository::class );

    // Set up service
    $this->userService = new UserService( $this->userPasswordHasher, $this->userRepository );
  }

  public function testCreateUser() : void
  {
    // Given user with password
    $plaintextPassword = 'testPassword123';
    $user = new User();

    // Given hashPassword returns hashed password
    $hashedPassword = 'hashedPassword123';
    $this->userPasswordHasher->method( 'hashPassword' )->willReturn( $hashedPassword );

    // Then we expect to call hashPassword once with user and password
    $this->userPasswordHasher->expects( self::once() )->method( 'hashPassword' )->with( $user, $plaintextPassword );

    // Then we expect to insert user
    $this->userRepository->expects( self::once() )->method( 'insert' )->with( $user );

    // When we call createUser
    $this->userService->createUser( $user, $plaintextPassword );

    // Then we expect hashed password to be set
    self::assertEquals( $hashedPassword, $user->getPassword() );
  }

  public function testExistsByUsername() : void
  {
    // Given username exists in the system
    $username = 'existinguser';
    $user = new User();
    $this->userRepository->method( 'findOneBy' )->willReturn( $user );

    // When we call existsByUsername
    $result = $this->userService->existsByUsername( $username );

    // Then we expect to get true
    self::assertTrue( $result );
  }

  public function testExistsByUsernameWithNonexistentUser()
  {
    // Given username does not exist
    $username = 'nonexistentuser';
    $this->userRepository->method( 'findOneBy' )->willReturn( null );

    // When we call existsByUsername
    $result = $this->userService->existsByUsername( $username );

    // Then we expect to get false
    self::assertFalse( $result );
  }

  public function testExistsByEmail() : void
  {
    // Given email exists in the system
    $email = 'existing@email.com';
    $user = new User();
    $this->userRepository->method( 'findOneBy' )->willReturn( $user );

    // When we call existsByEmail
    $result = $this->userService->existsByEmail( $email );

    // Then we expect to get true
    self::assertTrue( $result );
  }

  public function testExistsByEmailWithNonexistentEmail() : void
  {
    // Given email does not exist
    $email = 'nonexistent@email.com';
    $this->userRepository->method( 'findOneBy' )->willReturn( null );

    // When we call existsByEmail
    $result = $this->userService->existsByEmail( $email );

    // Then we expect to get false
    self::assertFalse( $result );
  }

  public function testGetUserByEmail() : void
  {
    // Given email
    $email = 'playeremail@email.com';

    // Given user exists
    $user = new User();
    $this->userRepository->method( 'findOneBy' )->willReturn( $user );

    // Then we expect to call findOneBy with provided email
    $this->userRepository->expects( self::once() )->method( 'findOneBy' )->with( [ 'email' => $email ] );

    // When we call getUserByEmail
    $result = $this->userService->getUserByEmail( $email );

    // Then we expect to get correct user
    self::assertSame( $user, $result );
  }
}
