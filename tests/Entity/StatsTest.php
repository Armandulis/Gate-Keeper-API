<?php

namespace App\Tests\Entity;

use App\Entity\BaseStats;
use App\Tests\Utils\TestCase;

/**
 * Class StatsTest
 */
final class StatsTest extends TestCase
{
  private BaseStats $stats;

  protected function setUp() : void
  {
    parent::setUp();

    // Given Stats entity
    $this->stats = new BaseStats();
  }

  public function testGetSetLevel() : void
  {
    // Given level set in stats
    $this->stats->setLevel( 10 );

    // When we get the level
    $result = $this->stats->getLevel();

    // Then level should be the same as set
    self::assertSame( 10, $result );
  }

  public function testGetSetHealth() : void
  {
    // Given health set in stats
    $this->stats->setHealth( 50.0 );

    // When we get the health
    $result = $this->stats->getHealth();

    // Then health should be the same as set
    self::assertSame( 50.0, $result );
  }

  public function testGetSetDefence() : void
  {
    // Given defence set in stats
    $this->stats->setDefence( 45.0 );

    // When we get the defence
    $result = $this->stats->getDefence();

    // Then defence should be the same as set
    self::assertSame( 45.0, $result );
  }

  public function testGetSetMana() : void
  {
    // Given mana set in stats
    $this->stats->setMana( 60.0 );

    // When we get the mana
    $result = $this->stats->getMana();

    // Then mana should be the same as set
    self::assertSame( 60.0, $result );
  }

  public function testGetSetDamage() : void
  {
    // Given damage set in stats
    $this->stats->setDamage( 35.0 );

    // When we get the damage
    $result = $this->stats->getDamage();

    // Then damage should be the same as set
    self::assertSame( 35.0, $result );
  }

  public function testGetSetLuck() : void
  {
    // Given luck set in stats
    $this->stats->setLuck( 0.8 );

    // When we get the luck
    $result = $this->stats->getLuck();

    // Then luck should be the same as set
    self::assertSame( 0.8, $result );
  }

  public function testGetSetCriticalDamage() : void
  {
    // Given criticalDamage set in stats
    $this->stats->setCriticalDamage( 30.0 );

    // When we get the criticalDamage
    $result = $this->stats->getCriticalDamage();

    // Then criticalDamage should be the same as set
    self::assertSame( 30.0, $result );
  }

  public function testGetSetLeach() : void
  {
    // Given leach set in stats
    $this->stats->setLeach( 5.0 );

    // When we get the leach
    $result = $this->stats->getLeach();

    // Then leach should be the same as set
    self::assertSame( 5.0, $result );
  }

  public function testGetSetSpeed() : void
  {
    // Given speed set in stats
    $this->stats->setSpeed( 7.0 );

    // When we get the speed
    $result = $this->stats->getSpeed();

    // Then speed should be the same as set
    self::assertSame( 7.0, $result );
  }

  public function testGetSetPerception() : void
  {
    // Given perception set in stats
    $this->stats->setPerception( 3.5 );

    // When we get the perception
    $result = $this->stats->getPerception();

    // Then perception should be the same as set
    self::assertSame( 3.5, $result );
  }

  public function testGetDataToArray() : void
  {
    // Given stats data is set
    $this->stats->setLevel( 10 )
      ->setHealth( 50.0 )
      ->setDefence( 45.0 )
      ->setMana( 60.0 )
      ->setDamage( 35.0 )
      ->setLuck( 0.8 )
      ->setCriticalDamage( 30.0 )
      ->setLeach( 5.0 )
      ->setSpeed( 7.0 )
      ->setPerception( 3.5 );

    // When we get the data as an array
    $result = $this->stats->dataToArray();

    // Then we expect to receive correctly formatted data array
    $expectedArray = [
      'id' => null,
      'level' => 10,
      'health' => 50.0,
      'defence' => 45.0,
      'mana' => 60.0,
      'damage' => 35.0,
      'luck' => 0.8,
      'criticalDamage' => 30.0,
      'leach' => 5.0,
      'speed' => 7.0,
      'perception' => 3.5,
    ];
    self::assertSame( $expectedArray, $result );
  }
}