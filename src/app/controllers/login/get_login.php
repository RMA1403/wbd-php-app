<?php

class GetLoginController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/login/login.php";
    require_once __DIR__ . "/../../views/home/home_view.php";
    session_start();
    
    if(isset($_SESSION['user_id'])){
      
      header("Location: http://localhost:8080/public/home?user_id=" . $_SESSION['user_id']);
    }else{
      $data = [];
      $view = new LoginView($data);
      $view->render();
    }

  }
}