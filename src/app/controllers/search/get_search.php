<?php

class GetSearchController
{
  
  public function call()
  {
    session_start();
    if (!isset($_SESSION["user_id"])) {
      http_response_code(403);
      header("Location: " . BASE_URL . "/login");

      return;
    }

    require_once __DIR__ . "/../../views/search/search_view.php";
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

    // List of all podcasts
    // search bar
    $keyword = "";
    if (isset($_GET["keyword"])) {
      $keyword = $_GET["keyword"];
    }

    // genre
    $genre = "";
    if (isset($_GET["genre"])) {
      $genre = $_GET["genre"];
    }

    // eps
    $eps = "";
    if (isset($_GET["eps"])) {
      $eps = $_GET["eps"];
    }

    // sort
    $sort = "";
    if (isset($_GET["sort"])) {
      $sort = $_GET["sort"];
    }

    // isAsc
    $isAsc = "";
    if (isset($_GET["isAsc"])) {
      $isAsc = $_GET["isAsc"];
    }

    $podcasts = $podcastModel->getAllPodcast($keyword, $genre, $eps, $sort, $isAsc);
    // print_r($podcasts);

    if ($podcasts){
      $data["podcasts"] = $podcasts;
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
    
    $view = new SearchView($data);
    if (isset($_GET["keyword"]) && $_GET["keyword"]="1"){
      $view->render_match();
    } else {
      $view->render();
    }
  }
}
