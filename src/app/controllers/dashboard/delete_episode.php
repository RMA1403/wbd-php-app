<?php

class DeleteEpisodeController
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

    // Check for user id
    if (!isset($_GET["id_user"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing user id"]);

      return;
    }

    // Check for episode id
    if (!isset($_GET["id_episode"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing episode id"]);

      return;
    }

    $episodeModel = new EpisodeModel();
    $oldEpisode = $episodeModel->getById($_GET["id_episode"]);
    $episodeModel->deleteEpisode($_GET["id_episode"]);
    unlink(__DIR__ . "/../../storage" . $oldEpisode->url_thumbnail);

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);

    return;
  }
}
