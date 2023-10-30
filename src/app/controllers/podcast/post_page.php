<?php

class PostPodcastPageController
{
  public function call()
  {
    session_start();
    if(!isset($_SESSION["user_id"])){
        header("Location: " . BASE_URL . "/login");

        return;
    }

    $idPodcast = "";
    $idPlaylist = "";
    if(isset($_POST["id_playlist"]) && isset($_POST["id_podcast"])){
        $idPlaylist = $_POST["id_playlist"];
        $idPodcast = $_POST["id_podcast"];
    }

    $model = new PlaylistModel();

    try{
        $model->addPodcastToPlaylist($idPlaylist, $idPodcast);
        http_response_code(201);
        exit;

    }catch(PDOException $e){
        // duplicate entries, violate integrity constraint (SQL code 23000)
        if($e->getCode() === 23000){
            http_response_code(203);
        }else{ // other type of error causing failure
            http_response_code(200);
        };
        exit;
    }
  }
}
