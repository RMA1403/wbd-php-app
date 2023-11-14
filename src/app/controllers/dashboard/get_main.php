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
    $resMessage = null;
    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else if ($_GET["premium"] == "true") {
      $idPodcast = $_GET["id_podcast"];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/podcast/" . $idPodcast);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $_ENV["REST_PHP_KEY"],
      ]);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $output = curl_exec($ch);
      curl_close($ch);

      $resMessage = json_decode($output, TRUE)["podcast"];
      if (!$resMessage["id_podcast"] || $resMessage["id_user"] != $_SESSION["user_id"]) {
        (new NotFoundController())->call();
        return;
      }
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
      "podcast" => $podcast ?? $resMessage,
      "episodes" => $episodes,
      "url_thumbnail" => $episodes[0]->url_thumbnail ?? "",
      "id_user" => $userId,
      "id_podcast" => $idPodcast,
    ];

    $view = new DashboardMainView($data);
    $view->render();
  }
}
