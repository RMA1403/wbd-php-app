<?php

class PostPlaylistController
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
        $model->removePodcastFromPlaylist($idPodcast, $idPlaylist);
        http_response_code(201);
        exit;
    }catch(PDOException $e){
        $e->getMessage();
        http_response_code(200);
        exit;
    }
    
  }
}
