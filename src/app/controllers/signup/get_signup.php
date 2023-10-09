<?php

class GetSignupController
{
  public function call()
  { 
    if(!isset($_SESSION['user_id'])){
      require_once __DIR__ . "/../../views/signup/signup.php";
    
      $data = [];
      $view = new SignupView($data);
      $view->render();
    }else{
      header("Location: " . BASE_URL . "/home");
    }

  }
}
