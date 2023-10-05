<?php

class GetAddEpisodeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/add_episode.php";

    $data = [
      // "episodes" => $episodes,
      // "url_thumbnail" => $episodes[0]->url_thumbnail ?? ""
    ];

    $view = new DashboardAddEpisodeView($data);
    $view->render();
  }
}
