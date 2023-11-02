<?php

class GetLoginController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/login/login.php";
    require_once __DIR__ . "/../../views/home/home_view.php";
    session_start();

    if (isset($_SESSION['user_id']) && $_SESSION["expire"] >= time()) {
      header("Location: " . BASE_URL . "/home?user_id=" . $_SESSION["user_id"]);
    } else {
      session_destroy();

      $data = [];
      $view = new LoginView($data);
      $view->render();
    }
  }
}
