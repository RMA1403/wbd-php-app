<?php

class GetUserPodcastController
{
  public function call()
  {
    // Check for user id
    if (!isset($_GET["id_user"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing user id"]);

      return;
    }

    $podcastModel = new PodcastModel();
    $podcasts = $podcastModel->getUserPodcasts($_GET["id_user"]) ?? [];
    $podcast = count($podcasts) > 0 ? $podcasts[0] : null;

    if (!$podcast) {
      http_response_code(500);
      header("Content-Type: application/json");
      echo json_encode(["message" => "user doesnt have any podcast"]);

      return;
    }

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["podcast" => $podcast]);

    return;
  }
}
