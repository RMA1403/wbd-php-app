<?php

class LogoutController
{
  public function call()
  {
    session_start();
    unset($_SESSION["user_id"]);
    session_destroy();

    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(["message" => "success"]);
  }
}
