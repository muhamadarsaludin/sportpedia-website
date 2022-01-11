<?php

namespace App\Controllers\Venue\Arena;

use App\Controllers\BaseController;

use App\Models\FieldSpecificationsModel;
use App\Models\SpecificationsModel;
use App\Models\ArenaModel;
use App\Models\ArenaImagesModel;
use App\Models\ArenaFacilitiesModel;
use App\Models\FieldsModel;
use App\Models\FacilitiesModel;
use App\Models\SportsModel;
use App\Models\VenueModel;
use App\Models\VenueLevelsModel;
use App\Models\UsersModel;
use App\Models\GroupsModel;
use App\Models\GroupsUsersModel;
use phpDocumentor\Reflection\Types\This;

class Field extends BaseController
{
  protected $fieldSpecificationsModel;
  protected $specificationsModel;
  protected $arenaModel;
  protected $arenaImagesModel;
  protected $arenaFacilitiesModel;
  protected $fieldsModel;
  protected $facilitiesModel;
  protected $sportsModel;
  protected $venueModel;
  protected $venueLevelsModel;
  protected $usersModel;
  protected $groupsModel;
  protected $groupsUsersModel;


  public function __construct()
  {
    $this->fieldspecificationsModel = new FieldSpecificationsModel();
    $this->specificationsModel = new SpecificationsModel();
    $this->arenaModel = new ArenaModel();
    $this->arenaImagesModel = new ArenaImagesModel();
    $this->arenaFacilitiesModel = new ArenaFacilitiesModel();
    $this->fieldsModel = new FieldsModel();
    $this->facilitiesModel = new FacilitiesModel();
    $this->sportsModel = new SportsModel();
    $this->venueModel = new VenueModel();
    $this->venueLevelsModel = new VenueLevelsModel();
    $this->usersModel = new UsersModel();
    $this->groupsModel = new GroupsModel();
    $this->groupsUsersModel = new GroupsUsersModel();
    helper('text');
  }

  public function add($slug)
  {
    $arena = $this->arenaModel->getArenaBySlug($slug)->getRowArray();
    $data = [
      'title'  => 'Tambah Lapangan | Sportpedia',
      'active' => 'venue-arena',
      'arena' => $arena,
      'specs' => $this->specificationsModel->getWhere(['sport_id' => $arena['sport_id']])->getResultArray(),
      'validation' => \Config\Services::validation(),
    ];
    // dd($data);
    return view('dashboard/venue/arena/field/add', $data);
  }

  public function save()
  {
    if (!$this->validate([
      'arena_id' => 'required',
      'field_name' => 'required',
      'field_image' => [
        'rules'  => 'uploaded[field_image]|max_size[field_image,5024]|ext_in[field_image,png,jpg,jpeg]',
        'errors' => [
          'ext_in' => "Extension must Image",
        ]
      ]
    ])) {
      return redirect()->to('/venue/arena/field/add/' . $this->request->getVar('arena_slug'))->withInput()->with('errors', $this->validator->getErrors());
    }

    $image = $this->request->getFile('field_image');
    $imageName = $image->getRandomName();
    $image->move('img/venue/arena/fields/main-images', $imageName);
    $fieldName = $this->request->getVar('field_name');
    $slug = strtolower(url_title($fieldName, '-') . '-' . random_string('numeric', 4));

    $this->fieldsModel->save([
      'arena_id' => $this->request->getVar('arena_id'),
      'field_name' => $fieldName,
      'field_image' => $imageName,
      'slug' => $slug,
      'description' => $this->request->getVar('description'),
    ]);

    session()->setFlashdata('message', 'Lapangan berhasil ditambahkan!');
    return redirect()->to('/venue/arena/main/detail/' .  $this->request->getVar('arena_slug'));
  }

  // Detail Lapangan
  public function detail($slug)
  {
    $data = [
      'title' => 'Detail Lapangan | Sportpedia',
      'field' => $this->fieldsModel->getWhere(['slug' => $slug])->getRowArray(),
    ];
    // dd($data);
    return view('dashboard/venue/arena/field/detail', $data);
  }
}
