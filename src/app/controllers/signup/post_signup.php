<?php

class PostSignupController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/signup/signup.php";
    require_once __DIR__ . "/../../models/user.php";

    
    if(isset($_POST['password'])){
      echo $_POST['username'];
    }

    if(isset($_POST['password'])){
      echo $_POST['password'];
    }

  }
}
