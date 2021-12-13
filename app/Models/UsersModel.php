<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  protected $table = 'users';
  protected $allowedFields = ['email', 'username', 'password_hash', 'user_image',  'active'];
  protected $useTimestamps = true;
}
