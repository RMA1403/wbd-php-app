<?php

class MountPlayerController
{
  public function call()
  {
    session_start();

    // Get id_episode from session
    $epsId = "";
    if (isset($_SESSION["eps_id"])) {
        $epsId = $_SESSION["eps_id"];
    }

    $data = [];

    // Data Player
    $podcastModel = new PodcastModel();
    $podcastInfo = $podcastModel->getPodcastInfo($epsId);
    if ($podcastInfo) {
      $data["title"] = $podcastInfo->title;
      $data["url_thumbnail"] = $podcastInfo->url_thumbnail;
      $data["podcast"] = $podcastInfo->name;
      $data["url_audio"] = $podcastInfo->url_audio;
    }

    require_once __DIR__ . "/../../views/player/player_view.php";
    $playerView = new PlayerView($data);
    $playerView->render();
}
}