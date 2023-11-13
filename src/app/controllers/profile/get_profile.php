<?php

class getProfileController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/login/login.php";
    session_start();
    // print_r($_SESSION);
    // if (isset($_SESSION['user_id'])) {
      $user_id = "4";
      // if (isset($_GET["user_id"])) {
      //   $user_id = $_GET["user_id"];
      // } 

      $userModel = new UserModel();
      $profile = $userModel->getUserInfo(4);
  
      $data = [
        "name" => $profile->name,
        "username" => $profile->username,
        "url_profpic" => $profile->url_profpic,
        "is_admin" => $profile->is_admin,
      ];
      header("Access-Control-Allow-Origin: http://localhost:3000");
      header("Access-Control-Allow-Credentials: true");
      header("Max-Age: 86400");
      header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
      // header("Access-Control-Allow-Headers: $_SERVER[HTTP_ACCESS_CONTROL_REQUEST_HEADERS]");
      echo json_encode($data);
    // } else {
    //   session_destroy();

    //   http_response_code(403);
    //   header("Location: " . BASE_URL . "/login");

    //   return;
    // }
  }
}