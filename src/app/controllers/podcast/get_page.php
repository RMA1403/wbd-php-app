<?php

class GetPodcastPageController
{
  public function call()
  {

    session_start();
    if (!isset($_SESSION["user_id"])) {
      http_response_code(403);
      header("Location: " . BASE_URL . "/login");

      return;
    }

    $idPodcast = "";
    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $idPodcast = $_GET["id_podcast"];
    }

    require_once __DIR__ . "/../../views/podcast/page.php";

    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();
    $playlistModel = new PlaylistModel();

    $podcast = $podcastModel->getById($idPodcast);
    $episodes = $episodeModel->getByPodcastId($idPodcast);
    $playlists = $playlistModel->getUserPlaylist($_SESSION["user_id"]);


    $data = [
      "podcast" => $podcast,
      "episodes" => $episodes,
      "libraries" => $playlists, 
    ];

    $view = new PodcastPageView($data);
    $view->render();
  }
}
