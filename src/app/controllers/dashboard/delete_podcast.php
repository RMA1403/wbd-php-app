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

    // Check is premium
    if ($_GET["premium"] == "true") {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/podcast/" . $_GET["id_podcast"]);
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
