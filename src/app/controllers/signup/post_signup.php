<?php

class PostSignupController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/signup/signup.php";
    require_once __DIR__ . "/../../models/user.php";

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $isAdmin = $_POST['isAdmin'];

        $admin = 0;

        if($isAdmin === "true"){
            $admin = 1;
        }


        $model = new UserModel();
        // $users = $model->getAllUsers();
    
        // $arrayUsers = json_decode(json_encode($users), true);
        // $query = 'INSERT INTO user (name, username, password, is_admin)
        //                     VALUES ($fullname, $username, $password, $isAdmin);' ;

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


    
    
    // $users = $model->getAllUsers();

    // echo $users[0]->username;
    // var_dump($users[0]);
    // $array = json_decode(json_encode($users), true);
    // var_dump($array);
    

  }
}
