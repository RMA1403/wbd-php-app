<?php

class GetDashboardController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/dashboard.php";
    require_once __DIR__ . "/../../models/podcast.php";

    $model = new PodcastModel();
    $podcasts = $model->getAllPodcast();

    $podcast = $podcasts[0];
    $data = [
      "title" => $podcast->title,
      "category" => $podcast->category,
      "url_thumbnail" => $podcast->url_thumbnail,
      "description" => $podcast->description
    ];
    
    $view = new DashboardView($data);
    $view->render();
  }
}
