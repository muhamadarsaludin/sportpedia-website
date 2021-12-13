<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecificationsModel extends Model
{
  protected $table = 'specifications';
  protected $allowedFields = ['sport_id', 'spec_name', 'spec_icon', 'description', 'active'];
  protected $useTimestamps = true;
}
