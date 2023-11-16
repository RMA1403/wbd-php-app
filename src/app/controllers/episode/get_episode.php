<?php

class GetEpisodeController
{
  public function call()
  {
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    $episodeModel = new EpisodeModel();

    $episode = $episodeModel->getById($_GET["idEpisode"]);

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["episode" => $episode]);

    return;
  }
}
