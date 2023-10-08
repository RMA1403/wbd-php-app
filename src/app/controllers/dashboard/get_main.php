<?php

class GetDashboardMainController
{
  public function call()
  {
    session_start();
    if (!isset($_SESSION["user_id"])) {
      http_response_code(403);
      header("Content-Type: application/json");
      echo json_encode(["message" => "unauthorized"]);

      return;
    }

    require_once __DIR__ . "/../../views/dashboard/main.php";

    $podcastModel = new PodcastModel();
    $episodeModel = new EpisodeModel();

    $userId = $_SESSION["user_id"];

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
      "url_thumbnail" => $episodes[0]->url_thumbnail ?? "",
      "id_user" => $userId,
      "id_podcast" => $idPodcast,
    ];

    $view = new DashboardMainView($data);
    $view->render();
  }
}
