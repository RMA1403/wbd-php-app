<?php

class PostLoginController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/login/login.php";
    require_once __DIR__ . "/../../models/user.php";

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        
    
        //TODO : hash password
        
        $model = new UserModel();
        try{
            $user = $model->getUser($_POST['username']);
            $user = json_decode(json_encode($user), true);

            if(!$user){
                http_response_code(404);
                exit;
            }else{
                if(password_verify($password, $user['password'])){
                    http_response_code(201);
                    header('Content-type: application/json');
                    echo json_encode(["redirect_url" => BASE_URL . "/signup"]);
                    exit;
                }else{
                    http_response_code(404);
                }
            }

        }catch(PDOException $e){
            echo $e->getCode();
            exit;
        }

        // $users = $model->getAllUsers();
    
        // $arrayUsers = json_decode(json_encode($users), true);
        // $query = 'INSERT INTO user (name, username, password, is_admin)
        //                     VALUES ($fullname, $username, $password, $isAdmin);' ;

        // try {
        //     $rowAffected = $model->insertUser($fullname, $username, $password, $admin);

        //     if($rowAffected > 0){
        //         http_response_code(201);
        //         header('Content-type: application/json');
        //         echo json_encode(["redirect_url" => BASE_URL . "/login"]);
        //         exit;
        //     }else{
        //         http_response_code(200);
        //         exit;
        //     }

        // }catch(PDOException $e){
        //     http_response_code(200);
        //     exit;
        // };
    }

    

  }
}
