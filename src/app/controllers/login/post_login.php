<?php

class PostLoginController
{
  public function call()
  {
    // require_once __DIR__ . "/../../views/login/login.php";
    session_start();

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
                
        $model = new UserModel();
        try{
            $user = $model->getUser($username);
            $user = json_decode(json_encode($user), true);

            if(!$user){
                http_response_code(401);
                exit;
            }else{
                if(password_verify($password, $user['password'])){
                    $_SESSION["user_id"] = $user['id_user'];
                    $_SESSION["eps_id"] = "";
                    $_SESSION["role_id"] = $user['is_admin'];
                    http_response_code(201);
                    header('Content-type: application/json');
                    echo json_encode(["redirect_url" => BASE_URL . "/home"]);
                    exit;
                }else{
                    http_response_code(401);
                }
            }

        }catch(PDOException $e){
            echo $e->getCode();
            exit;
        }
    }

  }
}
