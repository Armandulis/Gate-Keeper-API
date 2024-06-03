<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity( repositoryClass: UserRepository::class )]
#[ORM\UniqueConstraint( name: 'UNIQ_IDENTIFIER_EMAIL', fields: [ 'email' ] )]
class User implements UserInterface, PasswordAuthenticatedUserInterface, EntityInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column( length: 180, unique: true )]
  private ?string $email = null;

  #[ORM\Column( length: 180, unique: true )]
  private ?string $username = null;

  /**
   * @var list<string> The user roles
   */
  #[ORM\Column]
  private array $roles = [];

  #[ORM\Column]
  private ?string $password = null;

  /**
   * @var Collection<int, Character>
   */
  #[ORM\OneToMany( targetEntity: Character::class, mappedBy: 'user' )]
  private Collection $characters;

  public function __construct()
  {
    $this->characters = new ArrayCollection();
  }

  /**
   * Gets ID
   * @return int|null
   */
  public function getId() : ?int
  {
    return $this->id;
  }

  /**
   * Gets email
   * @return string|null
   */
  public function getEmail() : ?string
  {
    return $this->email;
  }

  /**
   * Sets email
   * @param string $email
   * @return self
   */
  public function setEmail( string $email ) : self
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Returns username
   * @return string
   */
  public function getUsername() : string
  {
    return $this->username;
  }

  /**
   * Sets username to user
   * @param string $username
   * @return $this
   */
  public function setUsername( string $username ) : self
  {
    $this->username = $username;

    return $this;
  }

  /**
   * A visual identifier that represents this user.
   * @return string
   */
  public function getUserIdentifier() : string
  {
    return (string) $this->email;
  }

  /**
   * Gets roles
   * @return string[]
   */
  public function getRoles() : array
  {
    $roles = $this->roles;
    $roles[] = 'ROLE_USER';

    return array_unique( $roles );
  }

  /**
   * Sets roles
   * @param string[] $roles
   */
  public function setRoles( array $roles ) : static
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * Gets password
   * @return string
   */
  public function getPassword() : string
  {
    return $this->password;
  }

  /**
   * Sets Password
   * @param string $password
   * @return $this
   */
  public function setPassword( string $password ) : static
  {
    $this->password = $password;

    return $this;
  }

  /**
   * This function is not needed for current implementation, but the interface is useful
   * @see UserInterface
   */
  public function eraseCredentials() : void
  {
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
  }

  /**
   * @return Collection<int, Character>
   */
  public function getCharacters() : Collection
  {
    return $this->characters;
  }

  public function addCharacter( Character $character ) : static
  {
    if( !$this->characters->contains( $character ) )
    {
      $this->characters->add( $character );
      $character->setUser( $this );
    }

    return $this;
  }

  public function removeCharacter( Character $character ) : static
  {
    if( $this->characters->removeElement( $character ) )
    {
      // set the owning side to null (unless already changed)
      if( $character->getUser() === $this )
      {
        $character->setUser( null );
      }
    }

    return $this;
  }

  /**
   * Returns entity data as array
   * @return array<string, int|string|bool>
   */
  public function dataToArray() : array
  {
    return [
      'id' => $this->id,
      'email' => $this->email,
      'username' => $this->username,
    ];
  }
}
