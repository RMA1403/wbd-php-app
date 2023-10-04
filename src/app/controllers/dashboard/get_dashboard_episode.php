<?php

class GetDashboardEpisodeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/dashboard_episode.php";

    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();
    $podcastId = "";
    if (!isset($_GET["podcast_id"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $podcastId = $_GET["podcast_id"];
    }

    $episodes = $episodeModel->getPodcastEpisodes($podcastId);

    $data = [
      "episodes" => $episodes,
      "url_thumbnail" => $episodes[0]->url_thumbnail ?? ""
    ];

    $view = new DashboardEpisodeView($data);
    $view->render();
  }
}
