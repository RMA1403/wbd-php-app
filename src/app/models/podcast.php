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
}
