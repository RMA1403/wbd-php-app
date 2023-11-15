<?php

class GetProfileController
{
  public function call()
  {
    session_start();
    
    if (isset($_SERVER["HTTP_API_KEY"])) {
      if ($_SERVER["HTTP_API_KEY"] != $_ENV["API_KEY"]) {
        http_response_code(403);
        session_destroy();
        return;
      }
    }

    $user_id = "";
    if (isset($_GET["user_id"])) {
      $user_id = $_GET["user_id"];
    } 

    $userModel = new UserModel();
    $profile = $userModel->getUserInfo(4);

    $data = [
      "name" => $profile->name,
      "username" => $profile->username,
      "url_profpic" => $profile->url_profpic,
    ];
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Max-Age: 86400");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    // header("Access-Control-Allow-Headers: $_SERVER[HTTP_ACCESS_CONTROL_REQUEST_HEADERS]");
    http_response_code(200);
    echo json_encode($data);
  }
}