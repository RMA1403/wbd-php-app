<?php

class PostLibraryController
{
  public function call()
  {
    session_start();
    
    if(!isset($_SESSION["user_id"])){
        header("Location: " . BASE_URL . "/login");

        return;
    }

    $playlistTitle = "";
    $idUser = $_SESSION["user_id"];

    if(isset($_POST["playlistTitle"])){
        $playlistTitle = $_POST["playlistTitle"];
    }
    

    $model = new PlaylistModel();

    try{
        $model->addPlaylist($idUser, $playlistTitle);
        http_response_code(201);
        exit;
    }catch(PDOException $e){
        http_response_code(200);
        echo($e->getMessage());
        exit;
    }
  }
}
