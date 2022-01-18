<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleDetailModel extends Model
{
  protected $table = 'schedule_detail';
  protected $allowedFields = ['schedule_id', 'start_time', 'end_time', 'active', 'price'];
  protected $useTimestamps = true;
}
