<?php

class GetPodcastController {
  public function call() {
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();

    $podcast = $podcastModel->getById($_GET["idPodcast"]);
    $episodes = $episodeModel->getAllPodcastEpisodes($_GET["idPodcast"]);

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["podcast" => $podcast, "episodes" => $episodes]);

    return;
  }
}