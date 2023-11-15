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
            if ((!isset($_POST['name']) || !isset($_POST['username'])) && !(file_get_contents('php://input') != null)) {
                http_response_code(403);
                echo json_encode(["message" => "invalid username or name"]);
                exit;
            }
            $name = "";
            $username = "";
            if (isset($_POST['name']) && isset($_POST['username'])){
                $name = $_POST['name'];
                $username = $_POST['username'];
            } else if ((file_get_contents('php://input') != null)){
                $data = json_decode(file_get_contents('php://input'), true);
                $name = $data['name'];
                $username = $data['username'];
            }

            try {
                if (!isset($_GET["user_id"]) && !isset($_SESSION["user_id"])) {
                    http_response_code(400);
                    echo json_encode(["message" => "Invalid user id"]);
                    exit;
                } else {
                    $user_id = "";
                    if (isset($_GET["user_id"])) {
                        $user_id = $_GET["user_id"];
                    } else {
                        $user_id = $_SESSION["user_id"];
                    }
                    $userModel = new UserModel();
                    $status = $userModel->updateProfile($user_id, $name, $username); 

                    if ($status == 200) {
                        http_response_code(200);
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
