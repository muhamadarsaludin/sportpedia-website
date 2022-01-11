<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\BannersModel;
use App\Models\SportsModel;
use App\Models\VenueModel;
use App\Models\VenueLevelsModel;
use App\Models\ArenaModel;
use App\Models\ArenaImagesModel;
use App\Models\ArenaFacilitiesModel;
use App\Models\FieldsModel;
use App\Models\FacilitiesModel;

class Main extends BaseController
{
  protected $usersModel;
  protected $bannersModel;
  protected $sportsModel;
  protected $venueModel;
  protected $venueLevelsModel;
  protected $arenaModel;
  protected $arenaImagesModel;
  protected $arenaFacilitiesModel;
  protected $fieldsModel;
  protected $facilitiesModel;



  public function __construct()
  {
    $this->usersModel = new UsersModel();
    $this->bannersModel = new BannersModel();
    $this->sportsModel = new SportsModel();
    $this->venueModel = new VenueModel();
    $this->venueLevelsModel = new VenueLevelsModel();
    $this->arenaModel = new ArenaModel();
    $this->arenaImagesModel = new ArenaImagesModel();
    $this->arenaFacilitiesModel = new ArenaFacilitiesModel();
    $this->fieldsModel = new FieldsModel();
    $this->facilitiesModel = new FacilitiesModel();
  }

  public function index()
  {
    $data = [
      'title'  => 'Home | Sportpedia',
      'banners' => $this->bannersModel->getWhere(['venue_id' => null, 'active' => 1])->getResultArray(),
      'sports' => $this->sportsModel->getAllSportAvailable()->getResultArray(),
      'arenas' => $this->arenaModel->getAllArena()->getResultArray(),
    ];
    // dd(my_info());
    return view('public/index', $data);
  }


  public function venue($slug)
  {
    $data = [
      'banners' => $this->bannersModel->getWhere(['venue_id' => null, 'active' => 1])->getResultArray(),
      'title' => 'Arena | Sportpedia',
      'venue' => $this->venueModel->getVenueBySlug($slug)->getRowArray(),
    ];
    // dd($data);
    return view('public/venue', $data);
  }



  public function arena($slug)
  {
    $data = [
      'title' => 'Arena | Sportpedia',
      'arena' => $this->arenaModel->getArenaBySlug($slug)->getRowArray(),
    ];
    $data['fields'] = $this->fieldsModel->getWhere(['arena_id' => $data['arena']['id']])->getResultArray();
    $data['facilities'] = $this->facilitiesModel->getArenaFacilitiesByArenaId($data['arena']['id'])->getResultArray();
    $data['images'] = $this->arenaImagesModel->getWhere(['arena_id' => $data['arena']['id']])->getResultArray();
    // dd($data);
    return view('public/arena', $data);
  }

  public function field($slug)
  {
    $data = [
      'title' => 'Lapangan | Sportpedia',
      'field' => $this->fieldsModel->getWhereSlug($slug)->getRowArray(),
    ];
    return view('public/field', $data);
  }
}
