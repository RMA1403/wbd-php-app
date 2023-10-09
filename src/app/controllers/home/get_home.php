<?php

class GetHomeController
{
  public function call()
  {
    session_start();
    
    require_once __DIR__ . "/../../views/home/home_view.php";
    $data = [];

    // podcast Info
    $podcastModel = new PodcastModel();
    $epsId = "";
    if (isset($_SESSION["eps_id"])) {
      $epsId = $_SESSION["eps_id"];
    }
    $podcastInfo = $podcastModel->getPodcastInfo($epsId);
    
    if ($podcastInfo){
      $data["title"] = $podcastInfo->title;
      $data["url_thumbnail"] = $podcastInfo->url_thumbnail;
      $data["podcast"] = $podcastInfo->name;
      $data["url_audio"] = $podcastInfo->url_audio;
    }

    $podcastTech = $podcastModel->getPodcastByGenre("technology");
    if ($podcastTech){
      var_dump($podcastTech);
      $data["tech_podcasts"] = $podcastTech;
    }

    // user info
    $userModel = new UserModel();
    $userId = "";
    if (isset($_SESSION["user_id"])) {
      $userId = $_SESSION["user_id"];
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
