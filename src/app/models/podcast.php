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
    $query = 
    "SELECT title, category, url_thumbnail, description, name 
    FROM podcast 
    NATURAL JOIN user
    ";
  
    $this->db->query($query);
    $podcasts = $this->db->fetchAll();
    return $podcasts;
  }

  public function getPodcastInfo($epsId)
  {
    $query = 
    "SELECT e.title, p.title AS name, e.url_thumbnail, e.url_audio  
    FROM podcast p
    INNER JOIN episode e ON e.id_podcast=p.id_podcast  
    WHERE e.id_episode = :eps_id
    ";

    $this->db->query($query);
    $this->db->bind("eps_id", $epsId);
    $podcastInfo = $this->db->fetch();

    return $podcastInfo;
  }

  public function getCategories()
  {
    $query = 
    "SELECT DISTINCT category 
    FROM podcast
    ";

    $this->db->query($query);
    $categories = $this->db->fetch();

    return $categories;
  }
}
