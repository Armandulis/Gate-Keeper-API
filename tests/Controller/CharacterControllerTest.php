<?php

namespace App\Tests\Controller;

use App\Controller\CharacterController;
use App\Entity\Character;
use App\Service\CharacterService;
use App\Tests\Utils\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class CharacterControllerTest
 */
final class CharacterControllerTest extends TestCase
{
  private CharacterService&MockObject $characterService;

  private CharacterController $characterController;

  protected function setUp() : void
  {
    parent::setUp();

    // Set up mocks
    $this->characterService = $this->createMock( CharacterService::class );

    // Set up controller
    $this->characterController = new CharacterController( $this->characterService );
    $this->prepareController( $this->characterController );
  }

  public function testGetCharacters() : void
  {
    // Given a list of characters
    $character = new Character();
    $character->setName( 'wizzard' );
    $this->characterService->method( 'getUserCharacters' )->willReturn( new ArrayCollection( [ $character ] ) );

    // When we call getCharacters
    $result = $this->characterController->getCharacters();

    // Then we expect to receive correct character data
    $data = json_decode( $result->getContent(), true );

    $expectedData = [
      'characters' => [
        [
          [
            'name' => 'wizzard',
            'id' => null,
            'type' => null,
            'experience' => null,
            'currentlySelected' => null,
            'backstory' => null,
            'stats' => null
          ]
        ],
      ],
    ];
    self::assertEquals( $expectedData, $data );
  }
}