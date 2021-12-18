<?php

namespace App\Controllers\Admin\Vendors;

use App\Controllers\BaseController;

use App\Models\VendorsModel;
use App\Models\VendorsLevelsModel;
use App\Models\UsersModel;

class Main extends BaseController
{
  protected $vendorsModel;
  protected $vendorsLevelsModel;
  protected $UsersModel;


  public function __construct()
  {
    $this->vendorsModel = new VendorsModel();
    $this->vendorsLevelsModel = new VendorsLevelsModel();
    $this->usersModel = new UsersModel();
    helper('text');
  }


  public function index()
  {
    $data = [
      'title'  => 'Daftar Vendor | Sportpedia',
      'active' => 'admin-vendor',
      'vendors'  => $this->vendorsModel->getAllVendors(),
    ];
    // dd($data);
    return view('dashboard/admin/vendors/main/index', $data);
  }


  // detail
  public function detail($id)
  {
    $data = [
      'title'  => 'Detail Vendor | Sportpedia',
      'active' => 'admin-vendors',
      'vendor' => $this->vendorsModel->getWhere(['id' => $id])->getRowArray(),
    ];
    $data['owner'] = $this->usersModel->getWhere(['id' => $data['vendor']['user_id']])->getRowArray();
    // dd($data);
    return view('dashboard/admin/vendors/main/detail', $data);
  }

  // Add Data
  public function add()
  {
    $data = [
      'title'  => 'Tambah Vendor | Sportpedia',
      'active' => 'admin-vendors',
      'validation' => \Config\Services::validation(),
      'levels' => $this->vendorsLevelsModel->get()->getResultArray()
    ];
    return view('dashboard/admin/vendors/main/add', $data);
  }
  public function save()
  {
    if (!$this->validate([
      'vendor-name' => 'required|is_unique[vendors.vendor_name]',
      'email' => 'required|valid_email',
      'logo' => [
        'rules'  => 'uploaded[logo]|max_size[logo,5024]|ext_in[logo,png,jpg,jpeg,svg]',
        'errors' => [
          'ext_in' => "Extension must Image",
        ]
      ],
    ])) {
      return redirect()->to('/admin/vendors/main/add')->withInput()->with('errors', $this->validator->getErrors());
    }
    $user = $this->usersModel->getWhere(['email' => $this->request->getVar('email')])->getRowArray();
    $vendorName = $this->request->getVar('vendor-name');
    $slug = url_title($vendorName, '-') . '-' . random_string('numeric', 5);

    $logo = $this->request->getFile('logo');
    $logo->move('img/vendors/logos');
    $logoName = $logo->getName();

    $this->vendorsModel->save([
      'vendor_name' => $vendorName,
      'user_id' => $user['id'],
      'slug' => $slug,
      'vendor_level_id' => $this->request->getVar('level'),
      'vendor_logo' => $logoName,
      'active' => 1
    ]);
    session()->setFlashdata('message', 'Vendor baru berhasil ditambahkan!');
    return redirect()->to('/admin/vendors/main');
  }


  // Edit data
  public function edit($id)
  {
    $data = [
      'title'  => 'Edit Vendor | sportpedia',
      'active' => 'admin-vendors',
      'validation' => \Config\Services::validation(),
      'vendor'  => $this->vendorsModel->getWhere(['id' => $id])->getRowArray(),
      'levels' => $this->vendorsLevelsModel->get()->getResultArray()
    ];
    $data['owner'] = $this->usersModel->getWhere(['id' => $data['vendor']['user_id']])->getRowArray();
    // dd($data);
    return view('dashboard/admin/vendors/main/edit', $data);
  }
  public function update($id)
  {
    $vendor = $this->vendorsModel->getWhere(['id' => $id])->getRowArray();

    if ($vendor['vendor_name'] == $this->request->getVar('vendor-name')) {
      $rulesVendorName = 'required';
      $slug = $vendor['slug'];
    } else {
      $rulesVendorName = 'required|is_unique[vendors.vendor_name]';
      $slug = url_title($this->request->getVar('vendor-name'), '-') . '-' . random_string('numeric', 5);
    }
    if (!$this->validate([
      'vendor-name' => $rulesVendorName,
      'email' => 'required|valid_email',
      'logo' => [
        'rules'  => 'max_size[logo,5024]|ext_in[logo,png,jpg,jpeg,svg]',
        'errors' => [
          'ext_in' => "Extension must Image",
        ]
      ],
    ])) {
      return redirect()->to('/admin/vendors/main/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
    }
    $user = $this->usersModel->getWhere(['email' => $this->request->getVar('email')])->getRowArray();
    $logo = $this->request->getFile('logo');

    if ($logo->getError() == 4) {
      $logoName = $vendor['vendor_logo'];
    } else {
      // pindahkan file
      $logo->move('img/vendors/logos');
      $logoName = $logo->getName();
      // hapus file lama
      if ($vendor['vendor_logo'] != 'default.png') {
        unlink('img/vendors/logos/' . $vendor['vendor_logo']);
      }
    }
    $this->vendorsModel->save([
      'id' => $id,
      'vendor_name' => $this->request->getVar('vendor-name'),
      'user_id' => $user['id'],
      'slug' => $slug,
      'vendor_level_id' => $this->request->getVar('level'),
      'vendor_logo' => $logoName,
      'active' => 1
    ]);
    session()->setFlashdata('message', 'Vendor berhasil diedit!');
    return redirect()->to('/admin/vendors/main');
  }
  // End Edit

  public function delete($id)
  {
    // cari role berdasarkan id
    $vendor = $this->vendorsModel->getWhere(['id' => $id])->getRowArray();
    if ($vendor['vendor_logo'] != 'default.png') {
      unlink('img/vendors/logos/' . $vendor['vendor_logo']);
    }

    $this->vendorsModel->delete($id);
    session()->setFlashdata('message', 'Vendors berhasil dihapus!');
    return redirect()->to('/admin/vendors/main');
  }
}
