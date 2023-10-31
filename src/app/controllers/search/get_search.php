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
    
    $podcastModel = new PodcastModel();
    $podcasts = $podcastModel->getAllPodcast($keyword, $genre, $eps, $sort, $isAsc);
    
    $data = [];
    if ($podcasts){
      $data["podcasts"] = $podcasts;
    }
    
    // Search View
    require_once __DIR__ . "/../../views/search/search_view.php";
    $view = new SearchView($data);
    if (isset($_GET["keyword"]) && $_GET["keyword"]="1"){
      $view->render_match();
    } else {
      $view->render();
    }
  }
}
