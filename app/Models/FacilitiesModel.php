<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilitiesModel extends Model
{
  protected $table = 'facilities';
  protected $allowedFields = ['facility_name', 'icon', 'description', 'active'];
  protected $useTimestamps = true;
}
