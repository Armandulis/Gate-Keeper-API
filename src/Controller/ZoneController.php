<?php

namespace App\Controller;

use App\Service\CharacterService;
use App\Service\ZoneService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route( '/api/zone', name: 'api_zone' )]
class ZoneController extends AbstractController
{
  public function __construct(
    private readonly ZoneService $zoneService,
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
   */
  #[Route( '/travel-options', name: 'travel-options', methods: 'GET' )]
  public function travelOptions() : JsonResponse
  {
    $character = $this->characterService->getSelectedUserCharacter();

    $this->zoneService->getAvailableTravelZones( $character );
    return $this->json([
      'zones' => []
    ]);
  }
}