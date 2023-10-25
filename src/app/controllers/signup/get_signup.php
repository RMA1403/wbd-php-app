<?php

class GetSignupController
{
  public function call()
  { 
    session_start();

    if(!isset($_SESSION['user_id'])){
      require_once __DIR__ . "/../../views/signup/signup.php";
    
      $data = [];
      $view = new SignupView($data);
      $view->render();
    }else{
      header("Location: " . BASE_URL . "/home?user_id=" . $_SESSION["user_id"]);
    }

  }
}
