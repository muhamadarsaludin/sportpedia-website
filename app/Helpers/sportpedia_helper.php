<?php

function my_info()
{
  if (logged_in()) {
    $usersModel = Model('UsersModel');
    $user = $usersModel->getUserById(user_id())->getRow();
    return $user;
  }
}
