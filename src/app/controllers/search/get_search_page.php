<?php

class GetHomeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/home/home_view.php";

    $model = new PodcastModel();
    $categories = $model->getAllPodcast();
    
    $userModel = new UserModel();
    $userId = "";
    if (isset($_GET["user_id"])) {
      $userId = $_GET["user_id"];
    }
    
    $userInfo = $userModel->getUserInfo($userId);

    $data = [
      "title" => $podcast->title,
      "category" => $podcast->category,
      "url_thumbnail" => $podcast->url_thumbnail,
      "podcaster" => $podcast->name,
    ];

    if ($userInfo) {
        $data["id_user"] = $userInfo->id_user;
        $data["name"] = $userInfo->name;
        $data["username"] = $userInfo->username;
        $data["url_profpic"] = $userInfo->url_profpic ?? "/images/default-profpic.jpeg";
        $data["is_admin"] = $userInfo->is_admin;
      }
    
    $view = new SearchView($data);
    $view->render();
  }
}
