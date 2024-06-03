<?php

namespace App\Entity;

/**
 * Interface EntityInterface
 */
interface EntityInterface
{
  /**
   * Gets the ID of the object.
   * @return int|null The ID of the object, or null if not available.
   */
  public function getId() : ?int;

  /**
   * Converts the data of the object into an array. Should be created with json compatibility in mind
   * @return array<string, string|int|bool> The data of the object as an array.
   */
  public function dataToArray() : array;
}
