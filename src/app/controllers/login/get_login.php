<?php

class GetLoginController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/login/login.php";
    require_once __DIR__ . "/../../views/home/home_view.php";
    session_start();
    
    if(isset($_SESSION['user_id'])){
      $userModel = new UserModel();
      $userId = $_SESSION['user_id'];

      $data = [];

      $userInfo = $userModel->getUserInfo($userId);
  
      if ($userInfo) {
        $data["name"] = $userInfo->name;
        $data["username"] = $userInfo->username;
        $data["url_profpic"] = $userInfo->url_profpic ?? "/images/default-profpic.jpeg";
        $data["is_admin"] = $userInfo->is_admin;
      }
      
      header("Location: http://localhost:8080/public/home?user_id=" . $userId);
    }

    $data = [];
    $view = new LoginView($data);
    $view->render();
  }
}
