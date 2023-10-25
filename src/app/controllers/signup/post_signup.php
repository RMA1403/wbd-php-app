<?php

class PostSignupController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/signup/signup.php";
    session_start();

    if(!isset($_SESSION['user_id'])){

        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['fullname']) && isset($_POST['isAdmin'])){
    
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $fullname = $_POST['fullname'];
            $isAdmin = $_POST['isAdmin'];
    
            $admin = 0;
            if($isAdmin === "true"){
                $admin = 1;
            }
    
            $model = new UserModel();
    
            try {
                $rowAffected = $model->insertUser($fullname, $username, $password, $admin);
    
                if($rowAffected > 0){
                    http_response_code(201);
                    header('Content-type: application/json');
                    echo json_encode(["redirect_url" => BASE_URL . "/login"]);
                    exit;
                }else{
                    http_response_code(200);
                    exit;
                }
    
            }catch(PDOException $e){
                http_response_code(200);
                exit;
            };
            
        }
    }

  }
}
