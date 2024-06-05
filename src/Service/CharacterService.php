<?php

namespace App\Service;

use App\Entity\Character;
use App\Entity\BaseStats;
use App\Entity\StatsLevels;
use App\Exception\NotAuthenticatedException;
use App\Provider\CurrentUserProvider;
use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\Collection;

/**
 * Class CharacterService
 */
class CharacterService
{
  /**
   * CharacterService constructor
   * @param CurrentUserProvider $currentUserProvider
   * @param CharacterRepository $characterRepository
   */
  public function __construct(
    private readonly CurrentUserProvider $currentUserProvider,
    private readonly CharacterRepository $characterRepository,
  )
  {
  }

  /**
   * Retrieves the characters belonging to the current user.
   * @return Collection<Character> The collection of characters belonging to the current user.
   * @throws NotAuthenticatedException
   */
  public function getUserCharacters() : Collection
  {
    $user = $this->currentUserProvider->getCurrentUser();
    $characters = $user->getCharacters();
    foreach( $characters as $character )
    {
      $this->calculateCharacterStats( $character );
    };
    return $characters;
  }

  /**
   * Retrieves the currently selected Character for the current User.
   * @return Character|null The currently selected Character, or null if none is found.
   * @throws NotAuthenticatedException
   */
  public function getSelectedUserCharacter() : ?Character
  {
    $user = $this->currentUserProvider->getCurrentUser();
    $character = $this->characterRepository->findOneBy( [ 'user' => $user, 'currentlySelected' => true ] );
    $this->calculateCharacterStats( $character );
    return $character;
  }

  /**
   * Creates a new user character
   * @param Character $character The character to create
   * @return Character The created character
   * @throws NotAuthenticatedException
   */
  public function createUserCharacter( Character $character ) : Character
  {
    $user = $this->currentUserProvider->getCurrentUser();
    $character->setUser( $user );

    $selectedCharacter = $this->getSelectedUserCharacter();
    if( $selectedCharacter === null )
    {
      $character->setCurrentlySelected( true );
    }

    $baseStats = new BaseStats();
    $character->setBaseStats( $baseStats );

    $statsLevels = new StatsLevels();
    $character->setStatsLevels( $statsLevels );

    $this->characterRepository->insert( $character );

    return $character;
  }

  public function calculateCharacterStats( Character $character ) : void
  {
    $baseStats = $character->getBaseStats();
    $statsLevels = $character->getStatsLevels();
    $character->characterStatsDTO->damage = $baseStats->getDamage() + ( $statsLevels->getDamageLevel() * 3 );
    $character->characterStatsDTO->luck = $baseStats->getLuck() + ( $statsLevels->getLuckLevel() * 0.1 );
    $character->characterStatsDTO->mana = $baseStats->getMana() + ( $statsLevels->getManaLevel() * 5 );
    $character->characterStatsDTO->defence = $baseStats->getDefence() + ( $statsLevels->getDefenceLevel() * 2 );
    $character->characterStatsDTO->criticalDamage = $baseStats->getCriticalDamage() + ( $statsLevels->getCriticalDamageLevel() * 3 );
    $character->characterStatsDTO->health = $baseStats->getHealth() + ( $statsLevels->getHealthLevel() * 5 );
    $character->characterStatsDTO->speed = $baseStats->getSpeed() + ( $statsLevels->getSpeedLevel() * 2 );
    $character->characterStatsDTO->leach = $baseStats->getLeach() + ( $statsLevels->getLeachLevel() * 0.5 );
  }

  public function characterLevelUp( Character $character, float $experienceRemainder ) : void
  {
    $baseStats = $character->getBaseStats();
    $baseStats->setHealth( $baseStats->getHealth() + 4 );
    $baseStats->setLuck( $baseStats->getLuck() + 0.01 );
    $baseStats->setDamage( $baseStats->getDamage() + 2 );
    $baseStats->setLeach( $baseStats->getLeach() + 0.5 );
    $baseStats->setMana( $baseStats->getMana() + 3 );
    $baseStats->setCriticalDamage( $baseStats->getCriticalDamage() + 1 );
    $baseStats->setPerception( $baseStats->getLuck() + 0.005 );
    $baseStats->setSpeed( $baseStats->getSpeed() + 1.5 );
    $statsLevels = $character->getStatsLevels();
    $statsLevels->setLevel( $statsLevels->getLevel() + 1 );
    $statsLevels->setExperience( $experienceRemainder );
    $this->characterRepository->insert( $character );
  }
}
