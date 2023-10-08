<?php

class GetLibraryController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/library/library_view.php";
    require_once __DIR__ . "/../../models/playlist.php";

    $data = [];
    session_start();
    if(isset($_SESSION['user_id'])){
        $playlistModel = new playlistModel();
        $userId = $_SESSION['user_id'];
  
        $data = [];
  
        $userPlaylist = $playlistModel->getUserPlaylist($userId);
        $playlist = json_decode(json_encode($userPlaylist), true);
        $data = $playlist;
        
        $view = new LibraryView($data);
        $view->render();
      }else{
        header("Location: ");
      }
    
  }
}
