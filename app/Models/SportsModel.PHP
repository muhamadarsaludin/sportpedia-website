<?php

namespace App\Models;

use CodeIgniter\Model;

class SportsModel extends Model
{
  protected $table = 'sports';
  protected $allowedFields = ['sport_name', 'slug', 'sport_icon', 'description', 'active'];
  protected $useTimestamps = true;
}
