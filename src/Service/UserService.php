<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserService
 */
class UserService
{
  /**
   * UserService constructor
   * @param UserPasswordHasherInterface $passwordHasher
   * @param UserRepository $userRepository
   */
  public function __construct(
    private readonly UserPasswordHasherInterface $passwordHasher,
    private readonly UserRepository $userRepository,
  )
  {
  }

  /**
   * Create a new user
   * @param User $user The user to be created
   * @param string $plaintextPassword The plain text password for the user
   * @return void
   */
  public function createUser( User $user, string $plaintextPassword ) : void
  {
    $hashedPassword = $this->passwordHasher->hashPassword( $user, $plaintextPassword );
    $user->setPassword( $hashedPassword );
    $this->userRepository->insert( $user );
  }

  /**
   * Check if a user exists by username.
   * @param string $username The username to check.
   * @return bool True if user exists, false otherwise.
   */
  public function existsByUsername( string $username ) : bool
  {
    $user = $this->userRepository->findOneBy( [ 'username' => $username ] );
    return $user !== null;
  }

  /**
   * Check if a user exists by email
   * @param string $email The email address to check
   * @return bool true if a user with the specified email exists, false otherwise
   */
  public function existsByEmail( string $email ) : bool
  {
    $user = $this->userRepository->findOneBy( [ 'email' => $email ] );
    return $user !== null;
  }

  /**
   * Retrieves a user by their email.
   * @param string $email The email of the user to retrieve.
   * @return User|null The user with the specified email, or null if no user is found.
   */
  public function getUserByEmail( string $email ) : ?User
  {
    return $this->userRepository->findOneBy( [ 'email' => $email ] );
  }
}
