<?php

namespace App\Exception;

use Exception;
use Throwable;

/**
 * Class NotAuthenticatedException
 */
class NotAuthenticatedException extends Exception
{
  /**
   * NotAuthenticatedException constructor
   * @param string $message
   * @param int $code
   * @param Throwable|null $previous
   */
  public function __construct( string $message = 'User not authenticated!', int $code = 401, ?Throwable $previous = null )
  {
    parent::__construct( $message, $code, $previous );
  }
}