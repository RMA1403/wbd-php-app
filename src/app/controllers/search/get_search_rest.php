<?php

class GetSearchPodcastRestController
{
  public function call()
  {
    $podcastModel = new PodcastModel();

    $keyword = "";
    $genre = "";
    if (isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
    }
    if (isset($_GET["genre"])){
        $genre = $_GET["genre"];
    }

    $podcasts = $podcastModel->getSearchPodcast($keyword, $genre);

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["podcasts" => $podcasts]);

    return;
  }
}
