<?php

namespace App\Controller;

use App\Entity\Character;
use App\Exception\NotAuthenticatedException;
use App\Service\CharacterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route( '/api', name: 'api_characters_' )]
class CharacterController extends AbstractController
{
  /**
   * CharacterController constructor
   * @param CharacterService $characterService
   */
  public function __construct(
    private readonly CharacterService $characterService
  )
  {
  }

  /**
   * Handles a request to fetch all user's characters
   * @Route("/characters", name="list", methods={'POST'})
   * @return JsonResponse
   * @throws NotAuthenticatedException
   */
  #[Route( '/characters', name: 'list', methods: 'GET' )]
  public function getCharacters() : JsonResponse
  {
    $characters = $this->characterService->getUserCharacters();

    // Convert character's data to array
    $data = [];
    foreach( $characters as $character )
    {
      $data[] = [
        $character->dataToArray()
      ];
    }

    return $this->json( [
      'characters' => $data,
    ] );
  }

  /**
   * Handles a request to fetch all user's characters
   * @Route("/characters", name="create", methods={'POST'})
   * @param Request $request
   * @return JsonResponse
   * @throws NotAuthenticatedException
   */
  #[Route( '/characters', name: 'create', methods: 'POST' )]
  public function createCharacter( Request $request ) : JsonResponse
  {
    $name = $request->request->get( 'name' );
    $type = $request->request->get( 'type' );
    $backstory = $request->request->get( 'backstory' );

    $character = new Character();
    $character->setName( $name );
    $character->setType( $type );
    $character->setBackstory( $backstory );

    $this->characterService->createUserCharacter( $character );

    return $this->json( [ 'characters' => $character->dataToArray() ] );
  }
}
