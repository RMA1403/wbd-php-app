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

    // Get all premium podcasts
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/podcast/by-user/" . $_SESSION["user_id"]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "apikey: " . $_ENV["REST_PHP_KEY"],
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $output = curl_exec($ch);
    curl_close($ch);

    $resMessage = json_decode($output, TRUE)["podcasts"];

    $podcastModel = new PodcastModel();
    $podcasts = $podcastModel->getUserPodcasts($_SESSION["user_id"]) ?? [];

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["podcasts" => $podcasts, "premium_podcasts" => $resMessage]);

    return;
  }
}
