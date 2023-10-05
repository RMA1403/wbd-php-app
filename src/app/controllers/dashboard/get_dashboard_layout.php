<?php

class GetDashboardLayoutController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/dashboard_layout.php";

    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();

    $userId = "";
    if (!isset($_GET["user_id"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $userId = $_GET["user_id"];
    }

    $podcasts = $podcastModel->getUserPodcasts($userId) ?? [];
    $podcast = count($podcasts) > 0 ? $podcasts[0] : null;

    $episodes = [];
    if ($podcast) {
      $episodes = $episodeModel->getTopThreeEpisodes($podcast->id_podcast);
    }

    $data = [
      "url_thumbnail" => $episodes[0]->url_thumbnail ?? ""
    ];

    $view = new DashboardLayoutView($data);
    $view->render();
  }
}
