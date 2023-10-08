<?php

class PostEditEpisodeController
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
    if (!isset($_POST["idEpisode"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing episode id"]);

      return;
    }

    // Check for episode title
    if (!isset($_POST["title"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing episode title"]);

      return;
    }

    // Check for image file
    if (isset($_POST["updateCover"]) && $_POST["updateCover"] && !isset($_FILES["imageFile"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing image file"]);

      return;
    }

    $episodeModel = new EpisodeModel();
    $oldEpisode = $episodeModel->getById($_POST["idEpisode"]);

    $imageFileName = $oldEpisode->url_thumbnail;
    // Store image file in server storage (if provided)
    if (isset($_POST["updateCover"]) && $_POST["updateCover"]) {
      unlink(__DIR__ . "/../../storage" . $oldEpisode->url_thumbnail);

      $imageMimeType = mime_content_type($_FILES["imageFile"]["tmp_name"]);
      $imageFileName = "/images/" . md5(uniqid(mt_rand(), true)) . IMAGE_MAP[$imageMimeType];
      move_uploaded_file($_FILES["imageFile"]["tmp_name"], __DIR__ . "/../../storage" . $imageFileName);
    }

    $episodeModel->updateEpisode($_POST["idEpisode"], $_POST["title"], $_POST["description"], $imageFileName);

    http_response_code(201);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);
  }
}
