<?php

class PlaylistModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUserPlaylist($id_user)
  {
    $query = "
      SELECT id_playlist, title FROM playlist
      WHERE id_user = :id_user
    ";

    $this->db->query($query);
    $this->db->bind("id_user", $id_user);
    $userPlaylist = $this->db->fetchAll();

    return $userPlaylist;
  }

  public function getPlaylistPodcast($id_playlist)
  {
    $query = "
    SELECT id_podcast FROM podcast_x_playlist
    WHERE id_playlist = :id_playlist
    ";

    $this->db->query($query);
    $this->db->bind("id_playlist", $id_playlist);
    $playlistPodcast = $this->db->fetchAll();

    return $playlistPodcast;
  }

}
