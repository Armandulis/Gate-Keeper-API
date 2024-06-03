<?php

namespace App\Provider;

use App\Entity\User;
use App\Exception\NotAuthenticatedException;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * Class CurrentUserProvider
 */
class CurrentUserProvider
{
  private $cachedUser = null;

  /**
   * CurrentUserProvider constructor
   * @param UserRepository $userRepository
   * @param Security $security
   */
  public function __construct(
    private readonly UserRepository $userRepository,
    private readonly Security $security
  )
  {
  }

  /**
   * Get the currently authenticated user.
   * @return User
   * @throws NotAuthenticatedException
   */
  public function getCurrentUser() : User
  {
    $loggedInUserIdentifier = $this->security->getUser()->getUserIdentifier();
    $currentUser = $this->cachedUser;
    $currentUser ??= $this->userRepository->findOneBy( [ 'email' => $loggedInUserIdentifier ] );

    if( $currentUser === null )
    {
      throw new NotAuthenticatedException();
    }

    return $currentUser;
  }
}
