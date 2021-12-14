<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\FacilityModel;
use App\Models\VendorsModel;

class Facility extends BaseController
{
  protected $facilityModel;
  protected $vendorsModel;

  public function __construct()
  {
    $this->facilityModel = new FacilityModel();
    $this->vendorsModel = new VendorsModel();
  }

  public function index()
  {
    $data = [
      'title'  => 'Fasilitas | Sportpedia',
      'active' => 'admin-facility',
      'facilities'  => $this->facilityModel->get()->getResultArray()
    ];
    return view('dashboard/admin/facility/index', $data);
  }

  // detail
  public function detail($id)
  {
    $data = [
      'title'  => 'Detail Fasilitas | Sportpedia',
      'active' => 'admin-facility',
      'facility' => $this->facilityModel->getWhere(['id' => $id])->getRowArray(),
    ];
    // dd($data);
    return view('dashboard/admin/facility/detail', $data);
  }



  // Add Data
  public function add()
  {
    $data = [
      'title'  => 'Tambah Fasilitas | Sportpedia',
      'active' => 'admin-facility',
      'validation' => \Config\Services::validation(),
    ];
    return view('dashboard/admin/facility/add', $data);
  }


  public function save()
  {
    if (!$this->validate([
      'facility' => 'required',
      'icon' => 'required'
    ])) {
      return redirect()->to('/admin/facility/add')->withInput()->with('errors', $this->validator->getErrors());
    }
    $this->facilityModel->save([
      'facility_name' => $this->request->getVar('facility'),
      'icon' => $this->request->getVar('icon'),
      'description' => $this->request->getVar('description'),
      'active' => 1
    ]);
    session()->setFlashdata('message', 'Fasilitas baru berhasil ditambahkan!');
    return redirect()->to('/admin/facility');
  }
  // End add data


  // Edit data
  public function edit($id)
  {
    $data = [
      'title'  => 'Edit Olahraga | sportpedia',
      'active' => 'admin-sport',
      'validation' => \Config\Services::validation(),
      'facility'  => $this->facilityModel->getWhere(['id' => $id])->getRowArray(),
    ];
    return view('dashboard/admin/facility/edit', $data);
  }

  public function update($id)
  {
    if (!$this->validate([
      'facility' => 'required',
      'icon' => 'required',
    ])) {
      return redirect()->to('/admin/facility/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
    }
    $this->facilityModel->save([
      'id'    => $id,
      'facility_name' => $this->request->getVar('facility'),
      'icon' => $this->request->getVar('icon'),
      'description' => $this->request->getVar('description'),
    ]);
    session()->setFlashdata('message', 'Data fasilitas berhasil diubah!');
    return redirect()->to('/admin/facility/');
  }

  // End Edit

  public function delete($id)
  {
    // cari role berdasarkan id
    $this->facilityModel->delete($id);
    session()->setFlashdata('message', 'Data fasilitas berhasil dihapus!');
    return redirect()->to('/admin/facility');
  }
}
