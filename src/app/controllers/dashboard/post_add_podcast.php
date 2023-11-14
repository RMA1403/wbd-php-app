<?php

class PostAddPodcastController
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

    // Check for podcast title
    if (!isset($_POST["title"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing podcast title"]);

      return;
    }

    // Check for podcast category
    if (!isset($_POST["category"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing podcast category"]);

      return;
    }

    // Check for image file
    if (!isset($_FILES["imageFile"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing image file"]);

      return;
    }

    // Store image file in server storage
    $imageMimeType = mime_content_type($_FILES["imageFile"]["tmp_name"]);
    $imageFileName = "/images/" . md5(uniqid(mt_rand(), true)) . IMAGE_MAP[$imageMimeType];
    move_uploaded_file($_FILES["imageFile"]["tmp_name"], __DIR__ . "/../../storage" . $imageFileName);

    // Check is premium
    if ($_POST["isPremium"] == "true") {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/podcast");
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
          "idUser" => $_SESSION["user_id"],
          "imageFile" => curl_file_create(__DIR__ . "/../../storage" . $imageFileName),
          "category" => $_POST["category"]
        ]
      );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $output = curl_exec($ch);
      curl_close($ch);

      unlink(__DIR__ . "/../../storage" . $imageFileName);

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

    $podcastModel = new PodcastModel();
    $podcastModel->savePodcast($_SESSION["user_id"], $_POST["title"], $_POST["description"], $_POST["category"], $imageFileName);

    http_response_code(201);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);
  }
}
