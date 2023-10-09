<?php

class GetPlaylistController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/playlist/playlist_view.php";
    require_once __DIR__ . "/../../models/playlist.php";
    session_start();
    
    if(isset($_SESSION['user_id']) && isset($_GET['playlist_id'])){
        
        $playlistModel = new PlaylistModel();
        $playlistPodcast = $playlistModel->getPlaylistPodcast($_GET['playlist_id']);

        $playlistPodcast = json_decode(json_encode($playlistPodcast),true);

        $data = [];
        $podcastModel = new PodcastModel();
        foreach($playlistPodcast as $podcast_id){
            $podcastData = $podcastModel->getById($podcast_id['id_podcast']);
            $podcastData = json_decode(json_encode($podcastData), true);

            array_push($data, $podcastData);
        }

        $view = new PlaylistView($data);
        $view->render();

    }
  }
}
