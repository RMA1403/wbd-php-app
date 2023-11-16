<?php

class AppController
{
  public function call()
  {
    // Session validation
    session_start();

    if (isset($_SESSION["is_premium"]) && $_SESSION["is_premium"]) {
      http_response_code(403);
      header("Location: http://localhost:5173");
      return;
    }

    if (!isset($_SESSION["user_id"])) {
      session_destroy();
      http_response_code(403);
      header("Location: " . BASE_URL . "/login");
      return;
    }

    if ($_SESSION["expire"] < time()) {
      session_destroy();
      http_response_code(403);
      header('Location: ' . BASE_URL . "/login");
      return;
    }




    // Get id_user from session
    $userId = "";
    if (isset($_SESSION["user_id"])) {
      $userId = $_SESSION["user_id"];
    }

    $data = [];

    // Data Profile
    $userModel = new UserModel();
    $userInfo = $userModel->getUserInfo($userId);
    if ($userInfo) {
      $data["name"] = $userInfo->name;
      $data["username"] = $userInfo->username;
      $data["url_profpic"] = $userInfo->url_profpic ?? "/images/default-profpic.jpeg";
      $data["is_admin"] = $userInfo->is_admin;
    }

    // App View
    require_once __DIR__ . "/../../views/app/app_view.php";
    $appView = new AppView($data);
    $appView->render();
  }
}
