<?php

namespace App\Tests\Service\Validation;

use App\Service\UserService;
use App\Service\Validation\UserValidationService;
use App\Tests\Utils\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class UserValidationServiceTest
 */
final class UserValidationServiceTest extends TestCase
{
  private UserService&MockObject $userService;

  private UserValidationService $userValidationService;

  protected function setUp() : void
  {
    parent::setUp();

    $this->userService = $this->createMock( UserService::class );
    $this->userValidationService = new UserValidationService( $this->userService );
  }

  public function testValidateEmailEmpty() : void
  {
    // Given email is empty
    $email = '';

    // When we call validateEmail
    $result = $this->userValidationService->validateEmail( $email );

    // Then we expect to receive error message
    self::assertSame( 'Invalid email address', $result );
  }

  public function testValidateEmailInvalid() : void
  {
    // Given email is invalid
    $email = 'email@';

    // When we call validateEmail
    $result = $this->userValidationService->validateEmail( $email );

    // Then we expect to receive error message
    self::assertSame( 'Invalid email address', $result );
  }

  public function testValidateEmailCorrect() : void
  {
    // Given email is valid
    $email = 'email@gmail.com';

    // When we call validateEmail
    $result = $this->userValidationService->validateEmail( $email );

    // Then we expect to receive null
    self::assertNull( $result );
  }

  public function testValidateEmailExists() : void
  {
    // Given email exists
    $email = 'exists@gmail.com';
    $this->userService->method( 'existsByEmail' )->willReturn( true );

    // Then we expect to call exists by email once
    $this->userService->expects( self::once() )->method( 'existsByEmail' )->with( $email );

    // When we call validateEmail
    $result = $this->userValidationService->validateEmail( $email );

    // Then we expect an error message
    self::assertSame( 'Email already exists', $result );
  }

  public function testValidatePasswordInvalid() : void
  {
    // Given password is invalid
    $password = '';

    // When we call validatePassword
    $result = $this->userValidationService->validatePassword( $password );

    // Then we expect to receive error message
    self::assertSame( 'Invalid password', $result );
  }

  public function testValidatePasswordCorrect() : void
  {
    // Given password is valid
    $password = 'real-password';

    // When we call validatePassword
    $result = $this->userValidationService->validatePassword( $password );

    // Then we expect to receive null
    self::assertNull( $result );
  }

  public function testValidateUsernameEmpty() : void
  {
    // Given username is empty
    $username = '';

    // When we call validateUsername
    $result = $this->userValidationService->validateUsername( $username );

    // Then we expect to receive error message
    self::assertSame( 'Invalid username', $result );
  }

  public function testValidateUsernameExists() : void
  {
    // Given username exists
    $username = 'exists';
    $this->userService->method( 'existsByUsername' )->willReturn( true );

    // Then we expect to call exists by username once
    $this->userService->expects( self::once() )->method( 'existsByUsername' )->with( $username );

    // When we call validateUsername
    $result = $this->userValidationService->validateUsername( $username );

    // Then we expect to receive error message
    self::assertSame( 'Username already exists', $result );
  }

  public function testValidateUsernameCorrect() : void
  {
    // Given username is valid and does not exist
    $username = 'validusername';
    $this->userService->method( 'existsByUsername' )->willReturn( false );

    // Then we expect to call exists by username once
    $this->userService->expects( self::once() )->method( 'existsByUsername' )->with( $username );

    // When we call validateUsername
    $result = $this->userValidationService->validateUsername( $username );

    // Then we expect to receive null
    self::assertNull( $result );
  }

  public function testValidateRegisterUserCorrect() : void
  {
    // Given password and email is valid
    $password = 'real-password';
    $email = 'email@gmail.com';
    $username = 'real-username';

    // When we call validateRegisterUser
    $result = $this->userValidationService->validateRegisterUser( $email, $password, $username );

    // Then we expect to receive null
    self::assertNull( $result );
  }

  public function testValidateRegisterUserAllInvalid() : void
  {
    // Given username, email and password is invalid
    $username = '';
    $email = '';
    $password = '';

    // When we call validateRegisterUser
    $result = $this->userValidationService->validateRegisterUser( $email, $password, $username );

    // Then we expect to receive a list of error messages
    self::assertSame( [ 'email' => 'Invalid email address', 'password' => 'Invalid password', 'username' => 'Invalid username' ], $result );
  }
}