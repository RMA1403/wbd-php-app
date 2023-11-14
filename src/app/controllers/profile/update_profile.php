<?php

class UpdateProfileController
{
    public function call()
    {
        
        if (isset($_SERVER["HTTP_API_KEY"])) {
            if ($_SERVER["HTTP_API_KEY"] != $_ENV["API_KEY"]) {
              http_response_code(403);
              return;
            }
        }

        if (isset($_SERVER["QUERY_STRING"])) {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            try {
                if (!isset($_SERVER["user_id"])) {
                    http_response_code(401);
                    echo json_encode(["message" => "Disni"]);
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
