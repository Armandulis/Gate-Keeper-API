<?php

namespace App\Service;

use App\Entity\Zone;
use App\Repository\ZoneRepository;

/**
 * Class ZoneService
 */
class ZoneService
{
  const ZONE_TRAVEL_LEVEL_RANGE = 3;

  /**
   * ZoneService constructor
   * @param ZoneRepository $zoneRepository
   */
  public function __construct( private readonly ZoneRepository $zoneRepository )
  {
  }

  /**
   * Retrieves the available travel zones for a given level.
   *
   * @param int $forLevel The level to find available travel zones for.
   * @return Zone[] An array of available travel zones.
   */
  public function getAvailableTravelZones( int $forLevel ) : array
  {
    $zones = $this->zoneRepository->findZonesInLevelRange( $forLevel - self::ZONE_TRAVEL_LEVEL_RANGE, $forLevel + self::ZONE_TRAVEL_LEVEL_RANGE );
    shuffle($zones);
    return array_slice($zones, 0, 3);
  }

  /**
   * Find a zone by travelZoneId
   * @param int $travelZoneId The ID of the travel zone to find
   * @return Zone|null The found zone or null if not found
   */
  public function findZone( int $travelZoneId ) : ?Zone
  {
    return $this->zoneRepository->find( $travelZoneId );
  }
}
