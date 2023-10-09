<?php

class PlaylistView
{
  public $data;

  public function __construct($data = [])
  {
    $this->data = $data;
  }

  public function render()
  {
    require_once __DIR__ . "/../../components/playlist/playlist.php";
  }

  public function render_playlist()
  {
    require_once __DIR__ . "/../../components/playlist/playlist_content.php";
  }
}
