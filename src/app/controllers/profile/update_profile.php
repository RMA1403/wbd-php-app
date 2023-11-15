<?php

class UpdateProfileController
{
    public function call()
    {
        if (isset($_SERVER["HTTP_API_KEY"])) {
            if ($_SERVER["HTTP_API_KEY"] != $_ENV["REST_PHP_KEY"]) {
                http_response_code(403);
                echo json_encode(["message" => "Invalid API key"]);
                return;
            }
        }

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Max-Age: 86400");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        if (isset($_SERVER["QUERY_STRING"])) {
            if (!isset($_POST['name']) || !isset($_POST['username'])) {
                http_response_code(403);
                echo json_encode(["message" => "invalid username or name"]);
                exit;
            }
            $name = $_POST['name'];
            $username = $_POST['username'];

            try {
                if (!isset($_GET["user_id"])) {
                    http_response_code(400);
                    echo json_encode(["message" => "Invalid user id"]);
                    exit;
                } else {
                    $userModel = new UserModel();
                    $status = $userModel->updateProfile($_GET["user_id"], $name, $username); 

                    if ($status == 200) {
                        if ($name== "woy") {
                            http_response_code(500);
                        } else {
                        }
                        http_response_code(500);
                        echo json_encode(["message" => "Profile updated successfully!", "name" => $name, "username" => $username]);
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
