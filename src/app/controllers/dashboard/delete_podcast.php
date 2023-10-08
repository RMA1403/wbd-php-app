<?php

class DeletePodcastController
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

    // Check for episode id
    if (!isset($_GET["id_podcast"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing podcast id"]);

      return;
    }

    $podcastModel = new podcastModel();
    $oldPodcast = $podcastModel->getById($_GET["id_podcast"]);
    $podcastModel->deletePodcast($_GET["id_podcast"]);
    unlink(__DIR__ . "/../../storage" . $oldPodcast->url_thumbnail);

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);

    return;
  }
}
