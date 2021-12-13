<?php

namespace App\Models;

use CodeIgniter\Model;

class ArenaModel extends Model
{
  protected $table = 'arena';
  protected $allowedFields = ['venue_id', 'sport_id', 'arena_name', 'slug', 'arena_image', 'rating', 'description', 'active'];
  protected $useTimestamps = true;
}
