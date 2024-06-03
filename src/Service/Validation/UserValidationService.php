<?php

namespace App\Service\Validation;

use App\Service\UserService;

/**
 * Class UserValidationService
 */
class UserValidationService
{
  public function __construct(
    private readonly UserService $userService
  )
  {
  }

  /**
   * Validates the given email.
   * This function checks if the email is properly formatted and does not already exist in the system.
   * @param string|null $email The email address to validate. If not provided or if it's not a valid email address, the function will return an error message.
   * @return string|null Returns an error message if the email is invalid or already exists, null otherwise.
   */
  public function validateEmail( ?string $email ) : ?string
  {
    if( empty( $email ) || !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
    {
      return 'Invalid email address';
    }

    if( $this->userService->existsByEmail( $email ) )
    {
      return 'Email already exists';
    }

    return null;
  }

  /**
   * Validates password
   * @param string|null $password The email address to validate.
   * @return string|null Returns a string with an error message if the email address is invalid, or null if it is valid.
   */
  public function validatePassword( ?string $password ) : ?string
  {
    if( empty( $password ) )
    {
      return 'Invalid password';
    }

    return null;
  }

  /**
   * Validates the given username.
   * This function checks if the username is not empty and does not already exist in the system.
   * @param string|null $username The username to validate. If not provided, the function will return an error message.
   * @return string|null Returns an error message if the username is invalid or already exists, null otherwise.
   */
  public function validateUsername( ?string $username ) : ?string
  {
    if( empty( $username ) )
    {
      return 'Invalid username';
    }

    if( $this->userService->existsByUsername( $username ) )
    {
      return 'Username already exists';
    }

    return null;
  }

  /**
   * Validates the registration user data.
   * @param string|null $email - The email address of the user.
   * @param string|null $password - The password of the user
   * @param string|null $username - The username of the user
   * @return array|null - An array containing the validation errors if there are any, otherwise null.
   */
  public function validateRegisterUser( ?string $email, ?string $password, ?string $username ) : ?array
  {
    $errors = [];
    $errors[ 'email' ] = $this->validateEmail( $email );
    $errors[ 'password' ] = $this->validatePassword( $password );
    $errors[ 'username' ] = $this->validateUsername( $username );
    $errors = array_filter( $errors );

    return empty( $errors ) ? null : $errors;
  }
}