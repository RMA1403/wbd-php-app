<?php

class GetHomeController
{
  public function call()
  {
    session_start();
    
    $data = [];
    
    // podcast Info
    $podcastModel = new PodcastModel();
    $podcastTech = $podcastModel->getPodcastByGenre("comedy");
    if ($podcastTech){
      $data["tech_podcasts"] = $podcastTech;
    }
    
    // Home View
    require_once __DIR__ . "/../../views/home/home_view.php";
    $view = new HomeView($data);
    $view->render();
  }
}
