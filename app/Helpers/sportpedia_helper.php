<?php

function my_info()
{
  if (logged_in()) {
    $usersModel = Model('UsersModel');
    $user = $usersModel->getUserByIdObj(user_id());
    return $user;
  }
}
