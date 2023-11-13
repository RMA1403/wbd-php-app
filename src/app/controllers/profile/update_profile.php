<?php

class UpdateProfileController
{
    public function call()
    {
        session_start();

        if (!isset($_SESSION["user_id"])) {
          session_destroy();
          http_response_code(403);
          return;
        }

        if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])) {

            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            try {
                if (!isset($_SERVER["user_id"])) {
                    http_response_code(401);
                    exit;
                } else {
                    $model = new UserModel();
                    $status = $model->updateProfile($_SESSION["user_id"], $name, $username, $password); 

                    if ($status == 200) {
                        http_response_code(200);
                        echo json_encode(["message" => "Profile updated successfully"]);
                        exit;
                    } else {
                        http_response_code(500);
                        echo json_encode(["message" => "Internal server error"]);
                        exit;
                    }
                }
            } catch (PDOException $e) {
                echo $e->getCode();
                http_response_code(500);
                echo json_encode(["message" => "Internal server error"]);
                exit;
            }
        }
    }
}
