<?php

class PodcastModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllPodcast()
  {
    $query = "SELECT title, category, url_thumbnail, description, name FROM podcast NATURAL JOIN user";

    $this->db->query($query);
    $podcasts = $this->db->fetchAll();

    return $podcasts;
  }

  public function getUserPodcasts($id_user)
  {
    $query = "
      SELECT * FROM podcast
      WHERE id_user = :id_user
    ";

    $this->db->query($query);
    $this->db->bind("id_user", $id_user);
    $podcasts = $this->db->fetchAll();

    return $podcasts;
  }

  public function getById($idPodcast)
  {
    $query = "
      SELECT * FROM podcast
      WHERE id_podcast = :idPodcast
    ";

    $this->db->query($query);
    $this->db->bind("idPodcast",  $idPodcast);
    $podcast = $this->db->fetch();

    return $podcast;
  }
}
