<?php

class PostLoginController
{
    public function call()
    {
        // require_once __DIR__ . "/../../views/login/login.php";
        session_start();

        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $model = new UserModel();
            try {
                $user = $model->getUser($username);
                $user = json_decode(json_encode($user), true);

                if (!$user) {
                    http_response_code(401);
                    exit;
                } else {
                    if (password_verify($password, $user['password'])) {
                        $_SESSION["start"] = time();
                        $_SESSION["expire"] = time() + 60 * 5;
                        $_SESSION["user_id"] = $user['id_user'];

                        if ($username == "premium") {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/token/create");
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                "Authorization: Bearer " . $_ENV["REST_PHP_KEY"],
                            ]);
                            curl_setopt(
                                $ch,
                                CURLOPT_POSTFIELDS,
                                http_build_query(array('idUser' => $user["id_user"]))
                            );
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                            $output = curl_exec($ch);
                            curl_close($ch);

                            $jwtToken = json_decode($output, TRUE)["token"];

                            $_SESSION["is_premium"] = true;

                            http_response_code(201);
                            header('Content-type: application/json');
                            echo json_encode(["redirect_url" => "http://localhost:5173/?token=" . $jwtToken]);
                            exit;
                        }

                        $_SESSION["eps_id"] = "";
                        $_SESSION["role_id"] = $user['is_admin'];
                        $_SESSION["is_premium"] = false;

                        http_response_code(201);
                        header('Content-type: application/json');
                        echo json_encode(["redirect_url" => BASE_URL . "/home"]);
                        exit;
                    } else {
                        http_response_code(401);
                    }
                }
            } catch (PDOException $e) {
                echo $e->getCode();
                exit;
            }
        }
    }
}
