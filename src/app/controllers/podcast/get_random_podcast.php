<?php

class GetRandomPodcastController
{
  public function call()
  {
    $podcastModel = new PodcastModel();

    $podcasts = $podcastModel->getRandom($_GET["category"]);

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["podcasts" => $podcasts]);

    return;
  }
}
