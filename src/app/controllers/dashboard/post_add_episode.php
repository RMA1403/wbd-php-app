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

    // Store audio file in server storage
    $audioMimeType = mime_content_type($_FILES["audioFile"]["tmp_name"]);
    $audioFileName = "/episodes/" . md5(uniqid(mt_rand(), true)) . AUDIO_MAP[$audioMimeType];
    move_uploaded_file($_FILES["audioFile"]["tmp_name"], __DIR__ . "/../../storage" . $audioFileName);

    // Store image file in server storage
    $imageMimeType = mime_content_type($_FILES["imageFile"]["tmp_name"]);
    $imageFileName = "/images/" . md5(uniqid(mt_rand(), true)) . IMAGE_MAP[$imageMimeType];
    move_uploaded_file($_FILES["imageFile"]["tmp_name"], __DIR__ . "/../../storage" . $imageFileName);

    $episodeModel = new EpisodeModel();
    $episodeModel->saveEpisode($_POST["idPodcast"], $_POST["title"], $_POST["description"], $imageFileName, $audioFileName);

    http_response_code(201);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);
  }
}
