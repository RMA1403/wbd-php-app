<?php

class PodcastModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllPodcast($keyword, $genre)
  {
    $query =
      "SELECT title, category, url_thumbnail, description, name 
    FROM podcast 
    NATURAL JOIN user
    WHERE (title LIKE :search_value
    OR name LIKE :search_value)
    ";

    $queryByGenre =
      "SELECT title, category, url_thumbnail, description, name 
    FROM podcast 
    NATURAL JOIN user
    WHERE (title LIKE :search_value
    OR name LIKE :search_value)
    AND category = :genre
    ";

    if ($genre == "") {
      $this->db->query($query);
    } else {
      $this->db->query($queryByGenre);
    }
    $this->db->bind("search_value", '%' . $keyword . '%');
    $this->db->bind("genre", $genre);
    $podcasts = $this->db->fetchAll();

    return $podcasts;
  }

  public function getPodcastByGenre($genre)
  {
    $queryByGenre =
      "SELECT title, category, url_thumbnail, description, name 
    FROM podcast 
    NATURAL JOIN user
    WHERE category = :genre
    LIMIT 7
    ";

    $this->db->bind("genre", $genre);
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

  public function savePodcast($id_user, $title, $description, $category, $image_url)
  {
    $query = "
      INSERT INTO podcast (title, description, category, url_thumbnail, id_user)
      VALUES (:title, :description, :category, :url_thumbnail, :id_user)
    ";

    $this->db->query($query);
    $this->db->bind("title", $title);
    $this->db->bind("description", $description);
    $this->db->bind("category", $category);
    $this->db->bind("url_thumbnail", $image_url);
    $this->db->bind("id_user", $id_user);

    $this->db->execute();
  }
}
