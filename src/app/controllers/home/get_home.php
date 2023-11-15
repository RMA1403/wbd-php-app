<?php

class GetHomeController
{
  public function call()
  {
    session_start();

    $data = [];
    $categories = ["comedy", "technology", "horror" ];

    // podcast Info
    $podcastModel = new PodcastModel();
    $podcastTech = $podcastModel->getPodcastByGenre("technology");
    $podcastComedy = $podcastModel->getPodcastByGenre("comedy");
    $podcastHorror = $podcastModel->getPodcastByGenre("horror");
    if ($podcastTech){
      $data["categories"] = $categories;
      $data["tech"] = $podcastTech;
      $data["comedy"] = $podcastComedy;
      $data["horror"] = $podcastHorror;
    }
    
    // Home View
    require_once __DIR__ . "/../../views/home/home_view.php";
    $view = new HomeView($data);
    $view->render();
  }
}
