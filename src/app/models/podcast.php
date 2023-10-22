<?php

class PodcastModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllPodcast($keyword, $genre, $eps, $sort, $isAsc)
  {
    $epsMin = "";
    $epsMax = "";
    switch ($eps) {
      case "Less than 20 episodes":
        $epsMin = "-1";
        $epsMax = "20";
        break;
      case "20-50 episodes":
        $epsMin = "20";
        $epsMax = "50";
        break;
      case "50-100 episodes":
        $epsMin = "50";
        $epsMax = "100";
        break;
      case "More than 100 episodes":
        $epsMin = "100";
        $epsMax = "999999999";
        break;
      default:
        $epsMin = "-1";
        $epsMax = "999999999";
        break;
    };
      
    //sort
    switch ($sort) {
      case "alphabetical":
        $query =
        "SELECT p.title, p.category, p.url_thumbnail, p.description, u.name
        FROM podcast AS p
        NATURAL JOIN user AS u
        LEFT JOIN episode AS e ON p.id_podcast = e.id_podcast
        WHERE (p.title LIKE :search_value
        OR u.name LIKE :search_value)
        AND p.category LIKE :genre
        GROUP BY p.id_podcast
        HAVING COUNT(e.id_episode) BETWEEN :epsMin AND :epsMax
        ORDER BY p.title 
        ";
        break;
      case "date joined":
        $query =
        "SELECT p.title, p.category, p.url_thumbnail, p.description, u.name
        FROM podcast AS p
        NATURAL JOIN user AS u
        LEFT JOIN episode AS e ON p.id_podcast = e.id_podcast
        WHERE (p.title LIKE :search_value
        OR u.name LIKE :search_value)
        AND p.category LIKE :genre
        GROUP BY p.id_podcast
        HAVING COUNT(e.id_episode) BETWEEN :epsMin AND :epsMax
        ORDER BY p.id_podcast 
        ";
        break;
      default:
        $query =
        "SELECT p.title, p.category, p.url_thumbnail, p.description, u.name
        FROM podcast AS p
        NATURAL JOIN user AS u
        LEFT JOIN episode e ON e.id_podcast=p.id_podcast 
        WHERE (p.title LIKE :search_value
        OR u.name LIKE :search_value)
        AND p.category LIKE :genre
        GROUP BY p.id_podcast
        HAVING COUNT(e.id_episode) BETWEEN :epsMin AND :epsMax
        ORDER BY p.description
        ";
        break;
    };
    

    $this->db->query($query);

    $this->db->bind("search_value", '%' . $keyword . '%');
    $this->db->bind("epsMin", $epsMin);
    $this->db->bind("epsMax", $epsMax);
    $this->db->bind("genre", $genre==""?'%':$genre);
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

  public function getPodcast($id_podcast) {
    $query = "
      SELECT * FROM podcast
      WHERE id_podcast = :id_podcast
    ";

    $this->db->query($query);
    $this->db->bind("id_podcast", $id_podcast);
    $podcast = $this->db->fetchAll();

    return $podcast;
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

  public function updatePodcast($id_podcast, $title, $description, $image_url)
  {
    $query = "
      UPDATE podcast
      SET title=:title, description=:description, url_thumbnail=:url_thumbnail
      WHERE id_podcast=:id_podcast
    ";

    $this->db->query($query);
    $this->db->bind("title", $title);
    $this->db->bind("description", $description);
    $this->db->bind("url_thumbnail", $image_url);
    $this->db->bind("id_podcast", $id_podcast);

    $this->db->execute();
  }

  public function deletePodcast($idPodcast)
  {
    $query = "
      DELETE FROM podcast
      WHERE id_podcast = :idPodcast
    ";

    $this->db->query($query);
    $this->db->bind("idPodcast", $idPodcast);

    $this->db->execute();
  }
}
