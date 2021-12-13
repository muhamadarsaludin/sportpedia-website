<?php

namespace App\Models;

use CodeIgniter\Model;

class FieledsModel extends Model
{
  protected $table = 'fields';
  protected $allowedFields = ['arena_id', 'field_name', 'slug', 'field_image', 'rating', 'amount_order', 'description', 'active'];
  protected $useTimestamps = true;
}
