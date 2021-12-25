<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\BannersModel;
use App\Models\SportsModel;
use App\Models\VenueModel;
use App\Models\VenueLevelsModel;
use App\Models\ArenaModel;
use App\Models\ArenaImagesModel;

class Main extends BaseController
{
  protected $usersModel;
  protected $bannersModel;
  protected $sportsModel;
  protected $venueModel;
  protected $venueLevelsModel;
  protected $arenaModel;
  protected $arenaImagesModel;


  public function __construct()
  {
    $this->usersModel = new UsersModel();
    $this->bannersModel = new BannersModel();
    $this->sportsModel = new SportsModel();
    $this->venueModel = new VenueModel();
    $this->venueLevelsModel = new VenueLevelsModel();
    $this->arenaModel = new ArenaModel();
    $this->arenaImagesModel = new ArenaImagesModel();
  }

  public function index()
  {
    $data = [
      'title'  => 'Home | Sportpedia',
      'banners' => $this->bannersModel->getWhere(['venue_id' => null, 'active' => 1])->getResultArray(),
      'sports' => $this->sportsModel->getWhere(['active' => 1])->getResultArray(),
      'arenas' => $this->arenaModel->getAllArena()->getResultArray()
    ];
    // dd(my_info());
    return view('public/index', $data);
  }

  public function arena($slug)
  {
    $data = [
      'title' => 'Arena | Sportpedia',
      'arena' => $this->arenaModel->getArenaBySlug($slug)->getRowArray(),
    ];
    $data['images'] = $this->arenaImagesModel->getWhere(['arena_id' => $data['arena']['id']])->getResultArray();
    // dd($data);
    return view('public/arena', $data);
  }
}
