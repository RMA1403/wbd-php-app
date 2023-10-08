<?php

class GetDashboardMainController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/main.php";

    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();

    $userId = "";
    if (!isset($_GET["id_user"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $userId = $_GET["id_user"];
    }

    $podcast = null;
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

    $episodes = [];
    if ($podcast) {
      $episodes = $episodeModel->getTopThreeEpisodes($podcast->id_podcast);
    }

    $data = [
      "podcast" => $podcast,
      "episodes" => $episodes,
      "url_thumbnail" => $episodes[0]->url_thumbnail ?? ""
    ];

    $view = new DashboardMainView($data);
    $view->render();
  }
}
