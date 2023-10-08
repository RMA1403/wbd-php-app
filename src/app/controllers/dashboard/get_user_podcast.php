<?php

class GetUserPodcastController
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

    $podcastModel = new PodcastModel();
    $podcasts = $podcastModel->getUserPodcasts($_SESSION["user_id"]) ?? [];

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["podcasts" => $podcasts]);

    return;
  }
}
