<?php

namespace App\Controllers\Admin\Users;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\GroupsUsersModel;

class Main extends BaseController
{
  protected $roleModel;


  public function __construct()
  {
    $this->rolesModel = new RolesModel();
    $this->usersModel = new UsersModel();
    $this->groupsUsersModel = new GroupsUsersModel();
  }


  public function index()
  {
    $data = [
      'title'  => 'Daftar User | Sportpedia',
      'active' => 'admin-users',
      'users'  => $this->usersModel->getAllUsers()
    ];
    // dd($data);
    return view('dashboard/admin/users/main/index', $data);
  }


  // detail
  public function detail($id)
  {
    $data = [
      'title'  => 'Detail User | Sportpedia',
      'active' => 'admin-users',
      'user' => $this->usersModel->getWhere(['id' => $id])->getRowArray(),
    ];
    // dd($data);
    return view('dashboard/admin/users/main/detail', $data);
  }

  // Add Data
  public function add()
  {
    $data = [
      'title'  => 'Tambah User | Sportpedia',
      'active' => 'admin-users',
      'validation' => \Config\Services::validation(),
      'roles' => $this->rolesModel->get()->getResultArray()
    ];
    return view('dashboard/admin/users/main/add', $data);
  }
  public function save()
  {
    if (!$this->validate([
      'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
      'email'    => 'required|valid_email|is_unique[users.email]',
      'password'     => 'required|strong_password',
      'pass_confirm' => 'required|matches[password]',
    ])) {
      return redirect()->to('/admin/users/main/add')->withInput()->with('errors', $this->validator->getErrors());
    }
    $this->usersModel->save([
      'username' => $this->request->getVar('username'),
      'email' => $this->request->getVar('email'),
      'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
      'active' => 1
    ]);
    $user = $this->usersModel->getWhere(['email' => $this->request->getVar('email')])->getRowArray();
    $this->groupsUsersModel->save([
      'group_id' => $this->request->getVar('role-id'),
      'user_id' => $user['id'],
    ]);

    session()->setFlashdata('message', 'User baru berhasil ditambahkan!');
    return redirect()->to('/admin/users/main');
  }


  // Edit data
  public function edit($id)
  {
    $data = [
      'title'  => 'Edit User | sportpedia',
      'active' => 'admin-users',
      'validation' => \Config\Services::validation(),
      'user'  => $this->usersModel->getUserById($id),
      'roles' => $this->rolesModel->get()->getResultArray()
    ];
    return view('dashboard/admin/users/main/edit', $data);
  }

  public function update($id)
  {

    $user = $this->usersModel->getWhere(['id' => $id])->getRowArray();
    $email = $this->request->getVar('email');
    $username = $this->request->getVar('username');

    $rules = [];

    if ($email == $user['email']) {
      $rules['email'] = 'required|valid_email';
    } else {
      $rules['email'] = 'required|valid_email|is_unique[users.email]';
    }
    if ($username == $user['username']) {
      $rules['username'] = 'required|alpha_numeric_space|min_length[3]|max_length[30]';
    } else {
      $rules['username'] = 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]';
    }


    $pass = $this->request->getVar('password');
    if ($pass) {
      $rules['password'] = 'strong_password';
      $rules['pass_confirm'] = 'matches[password]';
      $password = password_hash($pass, PASSWORD_DEFAULT);
      $password = $pass;
    } else {
      $password = $user['password_hash'];
    }


    if (!$this->validate($rules)) {
      return redirect()->to('/admin/users/main/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
    }

    dd($password);
    $this->usersModel->save([
      'id' => $id,
      'username' => $username,
      'email' => $email,
      'password_hash' => $password,
      'active' => 1
    ]);

    $aguId = $this->groupsUsersModel->getWhere(['user_id' => $id])->getRowArray();
    $this->groupsUsersModel->save([
      'id' => $aguId,
      'group_id' => $this->request->getVar('role-id'),
    ]);

    session()->setFlashdata('message', 'Data user berhasil diubah!');
    return redirect()->to('/admin/users/main');
  }
  // End Edit

  public function delete($id)
  {
    // cari role berdasarkan id
    $this->usersModel->delete($id);
    session()->setFlashdata('message', 'User berhasil dihapus!');
    return redirect()->to('/admin/users/main');
  }
}
