<?php

namespace App\Tests\Entity;

use App\Entity\Character;
use App\Entity\User;
use App\Tests\Utils\TestCase;

/**
 * Class UserTest
 */
final class UserTest extends TestCase
{
  private User $user;

  protected function setUp() : void
  {
    parent::setUp();

    // Set up entity
    $this->user = new User();
  }

  public function testEmail() : void
  {
    // Given email
    $this->user->setEmail( 'test@example.com' );

    // When we call getUser
    $result = $this->user->getEmail();

    // Then we expect to get the same email back
    self::assertEquals( 'test@example.com', $result );
  }

  public function testUserIdentifier() : void
  {
    // Given an email
    $this->user->setEmail( 'test@example.com' );

    // When we call getUserIdentifier
    $result = $this->user->getUserIdentifier();

    // Then we expect to get the same email back
    self::assertEquals( 'test@example.com', $result );
  }

  public function testUsername() : void
  {
    // Given username
    $this->user->setUsername( 'real-username' );

    // When we call getUser
    $result = $this->user->getUsername();

    // Then we expect to get the same username back
    self::assertEquals( 'real-username', $result );
  }

  public function testRoles() : void
  {
    // Given a role
    $this->user->setRoles( [ 'ROLE_TEST' ] );

    // When we call getRoles
    $result = $this->user->getRoles();

    // Then we expect to get the set role, along with the default 'ROLE_USER'
    self::assertContains( 'ROLE_TEST', $result );
    self::assertContains( 'ROLE_USER', $result );
  }

  public function testPassword() : void
  {
    // Given a password
    $this->user->setPassword( 'password123' );

    // When we call getPassword
    $result = $this->user->getPassword();

    // Then we expect to get the same password back
    self::assertEquals( 'password123', $result );
  }

  public function testEraseCredentials() : void
  {
    // Given a password is set
    $this->user->setPassword( 'password123' );

    // When we erase credentials
    $this->user->eraseCredentials();

    // Then we expect the password to remain unchanged (no data is erased in the current implementation)
    $result = $this->user->getPassword();
    self::assertEquals( 'password123', $result );
  }

  public function testGetCharacters() : void
  {
    // Given characters have been added to user
    $character1 = new Character();
    $this->user->addCharacter( $character1 );
    $character2 = new Character();
    $this->user->addCharacter( $character2 );

    // When we call getCharacters
    $characters = $this->user->getCharacters();

    // Then we expect to get correct characters
    self::assertCount( 2, $characters );
    self::assertTrue( $characters->contains( $character1 ) );
    self::assertTrue( $characters->contains( $character2 ) );
  }

  public function testRemoveCharacter() : void
  {
    // Given characters have been added to user
    $character1 = new Character();
    $this->user->addCharacter( $character1 );

    // When we remove the character
    $this->user->removeCharacter( $character1 );

    // When we call getCharacters
    $characters = $this->user->getCharacters();

    // Then the character should not exist in stats
    self::assertCount( 0, $characters );
  }

  public function testGetDataToArray() : void
  {
    // Given we have set the data in user
    $this->user->setEmail( "test@example.com" )->setUsername( "testuser" );

    // When we get the data as an array
    $result = $this->user->dataToArray();

    // Then the array should correctly represent the user data
    $expectedArray = [
      'id' => null,
      'email' => "test@example.com",
      'username' => "testuser",
    ];
    self::assertSame( $expectedArray, $result );
  }
}
