<?php

class PostPlayEpisodeController
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
    if (!isset($_POST["idEpisode"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing episode id"]);

      return;
    }

    $_SESSION["eps_id"] = $_POST["idEpisode"];

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);
  }
}
