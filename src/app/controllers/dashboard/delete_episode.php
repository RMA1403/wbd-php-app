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

    // Check for episode id
    if (!isset($_GET["id_episode"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing episode id"]);

      return;
    }

    // Check is premium
    if ($_GET["premium"] == "true") {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/episode/" . $_GET["id_episode"]);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $_ENV["REST_PHP_KEY"],
      ]);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $output = curl_exec($ch);
      curl_close($ch);

      $resMessage = json_decode($output, TRUE)["message"];

      if ($resMessage != "success") {
        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode(["message" => "bad request"]);

        return;
      }

      http_response_code(200);
      header("Content-Type: application/json");
      echo json_encode(["message" => "success"]);

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
