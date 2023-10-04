<?php

class GetHomeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/home/home_view.php";
    $data = [];

    // podcast Info
    $podcastModel = new PodcastModel();
    $epsId = "";
    if (isset($_GET["eps_id"])) {
      $epsId = $_GET["eps_id"];
    }
    $podcastInfo = $podcastModel->getPodcastInfo($epsId);
    
    if ($podcastInfo){
      $data["title"] = $podcastInfo->title;
      $data["url_thumbnail"] = $podcastInfo->url_thumbnail;
      $data["podcast"] = $podcastInfo->name;
      $data["url_audio"] = $podcastInfo->url_audio;
    }
    
    // user info
    $userModel = new UserModel();
    $userId = "";
    if (isset($_GET["user_id"])) {
      $userId = $_GET["user_id"];
    }
    $userInfo = $userModel->getUserInfo($userId);

    if ($userInfo) {
      $data["name"] = $userInfo->name;
      $data["username"] = $userInfo->username;
      $data["url_profpic"] = $userInfo->url_profpic ?? "/images/default-profpic.jpeg";
      $data["is_admin"] = $userInfo->is_admin;
    }
    
    $view = new HomeView($data);
    $view->render();
  }
}
