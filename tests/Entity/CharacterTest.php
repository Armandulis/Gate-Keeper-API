<?php

namespace App\Tests\Entity;

use App\Entity\Character;
use App\Entity\BaseStats;
use App\Entity\User;
use App\Tests\Utils\TestCase;

/**
 * Class CharacterTest
 */
final class CharacterTest extends TestCase
{
  private Character $character;

  protected function setUp() : void
  {
    parent::setUp();

    // Set up entity
    $this->character = new Character();
  }

  public function testGetSetUser() : void
  {
    // Given user is attached to character
    $user = new User();
    $this->character->setUser( $user );

    // When we call getUser
    $result = $this->character->getUser();

    // Then we expect to receive same user
    self::assertSame( $user, $result );
  }

  public function testGetSetStats() : void
  {
    // Given stats is attached to character
    $stats = new BaseStats();
    $this->character->setStats( $stats );

    // When we  call getStatus
    $result = $this->character->getStats();

    // Then we expect result to be same stats
    self::assertSame( $stats, $stats );
  }

  public function testGetSetName() : void
  {
    // Given character has name
    $this->character->setName( 'TestName' );

    // When we call getName
    $result = $this->character->getName();

    // then we expect result to be same name
    self::assertSame( 'TestName', $result );
  }

  public function testGetSetType() : void
  {
    // Given character has type
    $this->character->setType( 'TestType' );

    // When we call getType
    $result = $this->character->getType();

    // then we expect result to be same type
    self::assertSame( 'TestType', $result );
  }

  public function testGetSetExperience() : void
  {
    // Given character has experience
    $this->character->setExperience( 10.0 );

    // When we call getExperience
    $result = $this->character->getExperience();

    // Then we expect result to be same experience
    self::assertSame( 10.0, $result );
  }

  public function testGetSetCurrentlySelected() : void
  {
    // Given character is currently selected
    $this->character->setCurrentlySelected( true );

    // When we call isCurrentlySelected
    $result = $this->character->isCurrentlySelected();

    // Then we expect result to be true
    self::assertTrue( $result );
  }

  public function testGetSetBackstory() : void
  {
    // Given character has backstory
    $this->character->setBackstory( 'TestBackstory' );

    // When we call getBackstory
    $result = $this->character->getBackstory();

    // Then we expect to receive same backstory
    self::assertSame( 'TestBackstory', $result );
  }

  public function testGetDataToArray() : void
  {
    // Given we have stats
    $stats = $this->createMock( BaseStats::class );
    $stats->method( 'dataToArray' )->willReturn( [
        'health' => 100,
        'strength' => 10,
        'agility' => 10,
        'intelligence' => 10,
      ] );

    // Given we have character
    $this->character->setName( 'TestName' )
      ->setType( 'TestType' )
      ->setExperience( 10.0 )
      ->setCurrentlySelected( true )
      ->setBackstory( 'TestBackstory' )
      ->setStats( $stats );

    // when we call dataToArray
    $result = $this->character->dataToArray();

    // Then we expect to receive correctly formatted data array
    $expectedArray = [
      'id' => null,
      'name' => 'TestName',
      'type' => 'TestType',
      'experience' => 10.0,
      'currentlySelected' => true,
      'backstory' => 'TestBackstory',
      'stats' => [
        'health' => 100,
        'strength' => 10,
        'agility' => 10,
        'intelligence' => 10,
      ],
    ];
    self::assertSame( $expectedArray, $result );
  }
}
