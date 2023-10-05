<?php

class PodcastModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllPodcast($searchValue)
  {
    $query = 
    "SELECT title, category, url_thumbnail, description, name 
    FROM podcast 
    NATURAL JOIN user
    WHERE title LIKE :search_value
    OR name LIKE :search_value
    ";
  
    $this->db->query($query);
    $this->db->bind("search_value", '%' . $searchValue . '%');
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

}
