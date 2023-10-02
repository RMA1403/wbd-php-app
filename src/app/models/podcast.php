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
    $query = "SELECT * FROM podcast";

    $this->db->query($query);
    $podcasts = $this->db->fetchAll();

    return $podcasts;
  }
}
