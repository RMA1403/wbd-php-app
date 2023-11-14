<?php

class DeletePlaylistController
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

    if(isset($_GET["playlist_id"]) && isset($_GET["podcast_id"])){
        $idPlaylist = $_GET["playlist_id"];
        $idPodcast = $_GET["podcast_id"];
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
