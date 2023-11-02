<?php

class AppController
{
    public function call()
    {
        // Session validation
        session_start();

        if (isset($_SESSION["is_premium"]) && $_SESSION["is_premium"]) {
          http_response_code(403);
          header("Location: http://localhost:5173");
          return;
        }
        
        if (!isset($_SESSION["user_id"])) {
            http_response_code(403);
            header("Location: " . BASE_URL . "/login");
            return;
        }

        if ($_SESSION["expire"] < time()) {
          session_destroy();
          http_response_code(403);
          header('Location: ' . BASE_URL . "/login");
          return;
        }


        // Get id_episode from session
        $epsId = "";
        if (isset($_SESSION["eps_id"])) {
            $epsId = $_SESSION["eps_id"];
        }

        // Get id_user from session
        $userId = "";
        if (isset($_SESSION["user_id"])) {
          $userId = $_SESSION["user_id"];
        }

        $data = [];
        
        // Data Player
        $podcastModel = new PodcastModel();
        $podcastInfo = $podcastModel->getPodcastInfo($epsId);
        if ($podcastInfo){
          $data["title"] = $podcastInfo->title;
          $data["url_thumbnail"] = $podcastInfo->url_thumbnail;
          $data["podcast"] = $podcastInfo->name;
          $data["url_audio"] = $podcastInfo->url_audio;
        }

        // Data Profile
        $userModel = new UserModel();
        $userInfo = $userModel->getUserInfo($userId);
        if ($userInfo) {
            $data["name"] = $userInfo->name;
            $data["username"] = $userInfo->username;
            $data["url_profpic"] = $userInfo->url_profpic ?? "/images/default-profpic.jpeg";
            $data["is_admin"] = $userInfo->is_admin;
          }

        // App View
        require_once __DIR__ . "/../../views/app/app_view.php";
        $appView = new AppView($data);
        $appView->render();
    }
}