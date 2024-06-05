<?php

namespace App\Service;

use App\Entity\Character;
use App\Repository\ZoneRepository;

/**
 * Class ZoneService
 */
class ZoneService
{
  public function __construct( private readonly ZoneRepository $zoneRepository )
  {
  }

  public function getAvailableTravelZones( Character $character )
  {

    // $this->zoneRepository->findBy( [ '' ] );
  }
}
