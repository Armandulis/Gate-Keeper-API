<?php

namespace App;

enum TravelStatusEnum : string
{
  case IN_PROGRESS = 'IN_PROGRESS';
  case COMPLETED = 'COMPLETED';
  case EXPLORING = 'EXPLORING';
}
