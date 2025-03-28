<?php

namespace App\DTO;

interface DTOInterface
{
  /**
   * Converts the data of the object into an array. Should be created with json compatibility in mind
   * @return array<string, string|int|bool> The data of the object as an array.
   */
  public function dataToArray() : array;
}