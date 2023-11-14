<?php

class PostAddEpisodeController
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

    // Check for podcast id
    if (!isset($_POST["idPodcast"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing podcast id"]);

      return;
    }

    // Check for episode title
    if (!isset($_POST["title"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing episode title"]);

      return;
    }

    // Check for audio file
    if (!isset($_FILES["audioFile"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing audio file"]);

      return;
    }

    // Check for image file
    if (!isset($_FILES["imageFile"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing image file"]);

      return;
    }

    // Check uploaded file size
    if ($_FILES["audioFile"]["size"] > MAX_FILE_SIZE || $_FILES["imageFile"]["size"] > MAX_FILE_SIZE) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "file too large"]);

      return;
    }

    // Store audio file in server storage
    $audioMimeType = mime_content_type($_FILES["audioFile"]["tmp_name"]);
    $audioFileName = "/episodes/" . md5(uniqid(mt_rand(), true)) . AUDIO_MAP[$audioMimeType];
    move_uploaded_file($_FILES["audioFile"]["tmp_name"], __DIR__ . "/../../storage" . $audioFileName);

    // Store image file in server storage
    $imageMimeType = mime_content_type($_FILES["imageFile"]["tmp_name"]);
    $imageFileName = "/images/" . md5(uniqid(mt_rand(), true)) . IMAGE_MAP[$imageMimeType];
    move_uploaded_file($_FILES["imageFile"]["tmp_name"], __DIR__ . "/../../storage" . $imageFileName);

    // Check is premium
    if ($_POST["isPremium"] == "true") {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/episode");
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $_ENV["REST_PHP_KEY"],
      ]);
      curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        [
          "title" => $_POST["title"],
          "description" => $_POST["description"],
          "idPodcast" => $_POST["idPodcast"],
          "imageFile" => curl_file_create(__DIR__ . "/../../storage" . $imageFileName),
          "audioFile" => curl_file_create(__DIR__ . "/../../storage" . $audioFileName),
        ]
      );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $output = curl_exec($ch);
      curl_close($ch);

      unlink(__DIR__ . "/../../storage" . $imageFileName);
      unlink(__DIR__ . "/../../storage" . $audioFileName);

      $resMessage = json_decode($output, TRUE)["message"];

      if ($resMessage != "success") {
        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode(["message" => "bad request"]);

        return;
      }

      http_response_code(201);
      header("Content-Type: application/json");
      echo json_encode(["message" => "success"]);

      return;
    }

    $episodeModel = new EpisodeModel();
    $episodeModel->saveEpisode($_POST["idPodcast"], $_POST["title"], $_POST["description"], $imageFileName, $audioFileName);

    http_response_code(201);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);
  }
}
