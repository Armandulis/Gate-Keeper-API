<?php

namespace App\Controller;

use App\Exception\NotAuthenticatedException;
use App\Service\CharacterService;
use App\Service\TravelService;
use App\Service\ZoneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route( '/api/zone', name: 'api_zone' )]
class ZoneController extends AbstractController
{
  public function __construct(
    private readonly ZoneService $zoneService,
    private readonly TravelService $travelService,
    private readonly CharacterService $characterService,
  )
  {
  }

  /**
   * @Route("/list", name="zones", methods={'GET'})
   * @return JsonResponse
   */
  #[Route( '/list', name: 'list', methods: 'GET' )]
  public function list(): JsonResponse
  {
    return $this->json([
      'zones' => []
    ]);
  }

  /**
   * @Route("/travel-options", name="travel-options", methods={'GET'})
   * @return JsonResponse
   * @throws NotAuthenticatedException
   */
  #[Route( '/travel-options', name: 'travel-options', methods: 'GET' )]
  public function travelOptions() : JsonResponse
  {
    $character = $this->characterService->getSelectedUserCharacter();
    $zones = $this->zoneService->getAvailableTravelZones( $character->getStatsLevels()->getLevel() );

    $data = [];
    foreach( $zones as $zone )
    {
      $data[] = $zone->dataToArray();
    }

    return $this->json([
      'zones' => $data
    ]);
  }

  #[Route( '/start-travel', name: 'start-travel', methods: 'POST' )]
  public function startTravel( Request $request) : JsonResponse
  {
    $travelZone = $request->request->get( 'travelId' );
    $character = $this->characterService->getSelectedUserCharacter();
    $travel = $this->travelService->startTravel( $travelZone, $character );

    return $this->json([
      'travel' => $travel->dataToArray()
    ]);
  }
}