<?php

class DeleteLibraryController
{
  public function call()
  {
    session_start();
    
    if(!isset($_SESSION["user_id"])){
        header("Location: " . BASE_URL . "/login");

        return;
    }

    $playlistId = "";

    if(isset($_GET["playlist_id"])){
        $playlistId = $_GET["playlist_id"];
    }
    
    $model = new PlaylistModel();

    try{
        $model->deletePlaylist($playlistId);
        http_response_code(201);
        exit;
    }catch(PDOException $e){
        http_response_code(200);
        echo($e->getMessage());
        exit;
    }
  }
}
