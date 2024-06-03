<?php

namespace App\Controller;

use App\Exception\NotAuthenticatedException;
use App\Service\CharacterService;
use App\Service\StatsLevelsService;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route( '/api/stats/level', name: 'api_stats_levels' )]
class StatsLevelsController extends AbstractController
{
  /**
   * StatsLevelsController constructor
   * @param CharacterService $characterService
   * @param StatsLevelsService $statsLevelsService
   */
  public function __construct( private readonly CharacterService $characterService, private readonly StatsLevelsService $statsLevelsService )
  {
  }

  /**
   * Handles a request to fetch character $baseStats
   * @Route("/up", name="level_up", methods={'POST'})
   * @param Request $request
   * @return JsonResponse
   * @throws NotAuthenticatedException
   */
  #[Route( '/up', name: 'level_up', methods: 'POST' )]
  public function levelUpStat( Request $request ) : JsonResponse
  {
    $statsLevels = $this->characterService->getSelectedUserCharacter()->getStatsLevels();
    $statName = $request->request->get( 'statName' );

    try
    {
      $this->statsLevelsService->levelUpStat( $statsLevels, $statName );
    }
    catch( InvalidArgumentException )
    {
      return $this->json( [ 'error' => 'Stat with name ' . $statName . ' does not exist' ] );
    }

    // Convert character's data to array
    $data = $statsLevels->dataToArray();

    return $this->json( [
      'stats' => $data,
    ] );
  }

  /**
   * Handles a request to fetch character $baseStats
   * @Route("/down", name="level_down", methods={'POST'})
   * @param Request $request
   * @return JsonResponse
   * @throws NotAuthenticatedException
   */
  #[Route( '/down', name: 'level_down', methods: 'POST' )]
  public function levelDownStat( Request $request ) : JsonResponse
  {
    $statsLevels = $this->characterService->getSelectedUserCharacter()->getStatsLevels();
    $statName = $request->request->get( 'statName' );

    try
    {
      $this->statsLevelsService->levelDownStat( $statsLevels, $statName );
    }
    catch( InvalidArgumentException )
    {
      return $this->json( [ 'error' => 'Stat with name ' . $statName . ' does not exist' ] );
    }

    // Convert character's data to array
    $data = $statsLevels->dataToArray();

    return $this->json( [
      'stats' => $data,
    ] );
  }
}
