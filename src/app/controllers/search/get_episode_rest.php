<?php

class GetSearchEpisodeRestController
{
  public function call()
  {
    $episodeModel = new EpisodeModel();

    $keyword = "";
    $genre = "";
    if (isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
    }
    if (isset($_GET["genre"])){
        $genre = $_GET["genre"];
    }

    $episodes = $episodeModel->getSearchRest($keyword, $genre);

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["episodes" => $episodes]);

    return;
  }
}
