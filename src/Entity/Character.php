<?php

namespace App\Entity;

use App\DTO\CharacterStatsDTO;
use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity( repositoryClass: CharacterRepository::class )]
#[ORM\Table( name: '`character`' )]
class Character implements EntityInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\ManyToOne( inversedBy: 'characters' )]
  #[ORM\JoinColumn( nullable: false )]
  private ?User $user = null;

  #[ORM\OneToOne( cascade: [ 'persist', 'remove' ] )]
  #[ORM\JoinColumn( nullable: false )]
  private ?BaseStats $baseStats = null;

  #[ORM\OneToOne( cascade: [ 'persist', 'remove' ] )]
  #[ORM\JoinColumn( nullable: false )]
  private ?StatsLevels $StatsLevels = null;

  #[ORM\Column( length: 255 )]
  private ?string $name = null;

  #[ORM\Column( length: 255 )]
  private ?string $type = null;

  #[ORM\Column]
  private bool $currentlySelected = false;

  #[ORM\Column( length: 10000, nullable: true )]
  private ?string $backstory = null;

  /**
   * @var Collection<int, Travel>
   */
  #[ORM\OneToMany( targetEntity: Travel::class, mappedBy: 'characterEntity', orphanRemoval: true )]
  private Collection $travels;

  public CharacterStatsDTO $characterStatsDTO;

  public function __construct()
  {
    $this->travels = new ArrayCollection();
    $this->characterStatsDTO = new CharacterStatsDTO();
  }

  public function getId() : ?int
  {
    return $this->id;
  }

  public function getUser() : ?User
  {
    return $this->user;
  }

  public function setUser( ?User $user ) : static
  {
    $this->user = $user;

    return $this;
  }

  public function getBaseStats() : ?BaseStats
  {
    return $this->baseStats;
  }

  public function setBaseStats( BaseStats $baseStats ) : static
  {
    $this->baseStats = $baseStats;

    return $this;
  }

  public function getName() : ?string
  {
    return $this->name;
  }

  public function setName( string $name ) : static
  {
    $this->name = $name;

    return $this;
  }

  public function getType() : ?string
  {
    return $this->type;
  }

  public function setType( string $type ) : static
  {
    $this->type = $type;

    return $this;
  }

  public function isCurrentlySelected() : ?bool
  {
    return $this->currentlySelected;
  }

  public function setCurrentlySelected( bool $currentlySelected ) : static
  {
    $this->currentlySelected = $currentlySelected;

    return $this;
  }

  public function getBackstory() : ?string
  {
    return $this->backstory;
  }

  public function setBackstory( ?string $backstory ) : static
  {
    $this->backstory = $backstory;

    return $this;
  }

  public function getStatsLevels() : ?StatsLevels
  {
    return $this->StatsLevels;
  }

  public function setStatsLevels( StatsLevels $StatsLevels ) : static
  {
    $this->StatsLevels = $StatsLevels;

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
      'name' => $this->name,
      'type' => $this->type,
      'currentlySelected' => $this->currentlySelected,
      'backstory' => $this->backstory,
      'baseStats' => $this->baseStats?->dataToArray(),
      'characterStats' => $this->characterStatsDTO->dataToArray(),
    ];
  }

  /**
   * @return Collection<int, Travel>
   */
  public function getTravels() : Collection
  {
    return $this->travels;
  }

  public function addTravel( Travel $travel ) : static
  {
    if( !$this->travels->contains( $travel ) )
    {
      $this->travels->add( $travel );
      $travel->setCharacterEntity( $this );
    }

    return $this;
  }

  public function removeTravel( Travel $travel ) : static
  {
    if( $this->travels->removeElement( $travel ) )
    {
      // set the owning side to null (unless already changed)
      if( $travel->getCharacterEntity() === $this )
      {
        $travel->setCharacterEntity( null );
      }
    }

    return $this;
  }
}
