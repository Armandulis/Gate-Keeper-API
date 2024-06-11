<?php

namespace App\Service;

use App\Entity\Character;
use App\Entity\Travel;
use App\Repository\TravelRepository;
use App\TravelStatusEnum;
use Carbon\Carbon;
use LogicException;

/**
 * Class TravelService
 */
class TravelService
{
  /**
   * TravelService constructor
   * @param TravelRepository $travelRepository
   */
  public function __construct(
    private readonly TravelRepository $travelRepository,
    private readonly ZoneService $zoneService
  )
  {
  }

  /**
   * Starts a new travel for a character.
   * @param int $travelZoneId The ID of the travel zone.
   * @param Character $character The character entity.
   * @return Travel The created travel.
   */
  public function startTravel( int $travelZoneId, Character $character ) : Travel
  {
    $currentTravel = $this->travelRepository->findOneBy( [ 'character' => $character, 'status' => TravelStatusEnum::IN_PROGRESS->value ] );

    if( $currentTravel !== null )
    {
      throw new LogicException( 'Character is currently traveling!' );
    }

    $zone = $this->zoneService->findZone( $travelZoneId );

    $travel = new Travel();
    $travel->setCharacterEntity( $character );
    $travel->setZone( $zone );
    $travel->setStartTime( Carbon::now() );
    $travel->setStatus( TravelStatusEnum::IN_PROGRESS->value );
    $travel->setEndTime( Carbon::now()->add( $zone->getTravelTime() ) );

    $this->travelRepository->insert( $travel );

    return $travel;
  }

  public function completeTravel( Travel $travel ) : Travel
  {
    $travel->setStatus( TravelStatusEnum::EXPLORING->value );

    return $travel;
  }
}