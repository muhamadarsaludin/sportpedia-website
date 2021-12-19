<?php

namespace App\Models;

use CodeIgniter\Model;

class VenueModel extends Model
{
  protected $table = 'venue';
  protected $allowedFields = ['user_id', 'venue_name', 'logo', 'slug', 'level_id',  'rating', 'description', 'active', 'city', 'province', 'postal_code', 'address', 'latitude', 'logitude'];
  protected $useTimestamps = true;
}
