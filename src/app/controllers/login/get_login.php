<?php

class GetLoginController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/login/login.php";

    // $model = new PodcastModel();
    // $podcasts = $model->getAllPodcast();

    // $podcast = $podcasts[0];
    // $data = [
    //   "title" => $podcast->title,
    //   "category" => $podcast->category,
    //   "url_thumbnail" => $podcast->url_thumbnail,
    //   "description" => $podcast->description
    // ];
    
    $data = [];
    $view = new LoginView($data);
    $view->render();
  }
}
