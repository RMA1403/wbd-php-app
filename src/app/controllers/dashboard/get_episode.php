<?php

class GetDashboardEpisodeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/episode.php";

    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();

    $userId = "";
    if (!isset($_GET["id_user"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $userId = $_GET["id_user"];
    }

    $idPodcast = "";
    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $idPodcast = $_GET["id_podcast"];

      $podcast = $podcastModel->getById($idPodcast);

      if (!$podcast || $podcast->id_user != $userId) {
        (new NotFoundController())->call();
        return;
      }
    }

    $episodes = $episodeModel->getPodcastEpisodes($idPodcast);

    $data = [
      "episodes" => $episodes,
      "url_thumbnail" => $episodes[0]->url_thumbnail ?? ""
    ];

    $view = new DashboardEpisodeView($data);
    $view->render();
  }
}
