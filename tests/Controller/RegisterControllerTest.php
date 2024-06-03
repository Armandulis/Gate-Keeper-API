<?php

namespace App\Tests\Controller;

use App\Controller\RegisterController;
use App\Service\UserService;
use App\Service\Validation\UserValidationService;
use App\Tests\Utils\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class RegisterControllerTest
 */
final class RegisterControllerTest extends TestCase
{
  private UserService&MockObject $userService;

  private UserValidationService&MockObject $userValidationService;

  private RegisterController $registerController;

  protected function setUp() : void
  {
    parent::setUp();

    // Set up mocks
    $this->userService = $this->createMock( UserService::class );
    $this->userValidationService = $this->createMock( UserValidationService::class );

    // Set up controller
    $this->registerController = new RegisterController( $this->userService, $this->userValidationService );
    $this->prepareController( $this->registerController );
  }

  public function testRegister() : void
  {
    // Given user provided email, password, and username
    $this->request->request->set( 'password', 'userPass' );
    $this->request->request->set( 'email', 'userEmail@gmail.com' );
    $this->request->request->set( 'username', 'username-real' );

    // Given input is valid
    $this->userValidationService->method( 'validateRegisterUser' )->willReturn( null );

    // Then we expect to call createUser with user and plaintextPassword
    $this->userService->expects( self::once() )->method( 'createUser' )->with( self::anything(), 'userPass' );

    // When we call register
    $response = $this->registerController->register( $this->request );

    // Then we expect response to contain success message with user email
    self::assertSame( '{"message":"User with email userEmail@gmail.com successfully created!"}', $response->getContent() );
    self::assertSame( 200, $response->getStatusCode() );
  }

  public function testRegisterInvalidInput() : void
  {
    // Given user provided no email, invalid password, and non-unique username
    $this->request->request->set( 'password', '' );
    $this->request->request->set( 'username', 'player' );

    // Given validation fails
    $this->userValidationService->method( 'validateRegisterUser' )->willReturn( [ 'email' => 'missing', 'username' => 'not unique' ] );

    // When we call register
    $response = $this->registerController->register( $this->request );

    // Then we expect response to contain error message
    self::assertSame( '{"errors":{"email":"missing","username":"not unique"}}', $response->getContent() );
    self::assertSame( 400, $response->getStatusCode() );
  }
}
