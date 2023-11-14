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

    $imageFileName = $oldEpisode->url_thumbnail ?? "";
    // Store image file in server storage (if provided)
    if (isset($_POST["updateCover"]) && $_POST["updateCover"]) {
      if ($oldEpisode) {
        unlink(__DIR__ . "/../../storage" . $oldEpisode->url_thumbnail);
      }

      $imageMimeType = mime_content_type($_FILES["imageFile"]["tmp_name"]);
      $imageFileName = "/images/" . md5(uniqid(mt_rand(), true)) . IMAGE_MAP[$imageMimeType];
      move_uploaded_file($_FILES["imageFile"]["tmp_name"], __DIR__ . "/../../storage" . $imageFileName);
    }

    // Check is premium
    if ($_POST["isPremium"] == "true") {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/episode/" . $_POST["idEpisode"]);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $_ENV["REST_PHP_KEY"],
      ]);
      $data = [
        "title" => $_POST["title"],
        "description" => $_POST["description"],
        "updateCover" => $_POST["updateCover"] ?? "false",
      ];
      if (isset($_POST["updateCover"]) && $_POST["updateCover"]) {
        $data["imageFile"] = curl_file_create(__DIR__ . "/../../storage" . $imageFileName);
      }
      curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        $data
      );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $output = curl_exec($ch);
      curl_close($ch);

      if (isset($_POST["updateCover"]) && $_POST["updateCover"]) {
        unlink(__DIR__ . "/../../storage" . $imageFileName);
      }

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

    $episodeModel->updateEpisode($_POST["idEpisode"], $_POST["title"], $_POST["description"], $imageFileName);

    http_response_code(201);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);
  }
}
