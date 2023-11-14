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

  public function addPlaylist($id_user, $title)
  {
    $query = "
    INSERT INTO playlist (title, id_user) 
    VALUES(:title, :id_user)
    ";

    $this->db->query($query);
    $this->db->bind("id_user", $id_user);
    $this->db->bind("title", $title);

    $this->db->execute();
  }

  public function addPodcastToPlaylist($id_playlist, $id_podcast)
  {
    $query = "
    INSERT INTO podcast_x_playlist (id_playlist, id_podcast)
    VALUES(:id_playlist, :id_podcast)
    ";

    $this->db->query($query);
    $this->db->bind("id_playlist", $id_playlist);
    $this->db->bind("id_podcast", $id_podcast);

    $this->db->execute();

  }

  public function deletePlaylist($id_playlist)
  {
    $query = "
    DELETE FROM playlist
    WHERE id_playlist = :id_playlist
    ";

    $this->db->query($query);
    $this->db->bind("id_playlist", $id_playlist);

    $this->db->execute();
  }

  public function removePodcastFromPlaylist($id_podcast, $id_playlist)
  {
    $query = "
    DELETE FROM podcast_x_playlist
    WHERE id_playlist = :id_playlist AND id_podcast = :id_podcast
    ";

    $this->db->query($query);
    $this->db->bind("id_playlist", $id_playlist);
    $this->db->bind("id_podcast", $id_podcast);

    $this->db->execute();
  }

}
