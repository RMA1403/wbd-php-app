<?php

class GetEpisodePlayed
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

    // Check for current eps id
    if (!isset($_SESSION["eps_id"])) {
      http_response_code(400);
      header("Content-Type: application/json");
      echo json_encode(["message" => "missing episode id"]);
      return;
    }

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success", "eps_id" => $_SESSION["eps_id"]]);
  }
}
