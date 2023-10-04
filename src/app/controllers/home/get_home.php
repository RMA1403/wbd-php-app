<?php

class GetHomeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/home/home_view.php";
    require_once __DIR__ . "/../../models/podcast.php";

    $model = new PodcastModel();
    $podcasts = $model->getAllPodcast();

    $podcast = $podcasts[0];
    $data = [
      "title" => $podcast->title,
      "category" => $podcast->category,
      "url_thumbnail" => $podcast->url_thumbnail,
      "podcaster" => $podcast->name,
    ];
    
    $view = new HomeView($data);
    $view->render();
  }
}
