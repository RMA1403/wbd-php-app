<?php

class GetDashboardController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/dashboard.php";

    $userModel = new UserModel();
    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();

    $userId = "";
    if (!isset($_GET["user_id"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $userId = $_GET["user_id"];
    }

    $podcasts = $userModel->getUserPodcasts($userId) ?? [];    
    $podcast = count($podcasts) > 0 ? $podcasts[0] : null;

    $episodes = [];
    if ($podcast) {
      $episodes = $episodeModel->getTopThreeEpisodes($podcast->id_podcast);
    }
    
    $data = [
      "podcast" => $podcast,
      "episodes" => $episodes
    ];

    $view = new DashboardView($data);
    $view->render();
  }
}
