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
    $eps_new = "";
    switch ($eps) {
      case "eps-cat-1":
        $eps_new = "COUNT(e) < 20";
        break;
      case "eps-cat-2":
        $eps_new = "COUNT(e) BETWEEN 20 AND 50";
        break;
      case "eps-cat-3":
        $eps_new = "COUNT(e) BETWEEN 50 AND 100";
        break;
      case "eps-cat-4":
        $eps_new = "COUNT(e) > 100";
        break;
      default:
        $eps_new = "COUNT(e) > -1";
        break;
    };

    $sort_new = "";
    //sort
    switch ($sort) {
      case "alphabet":
        $sort_new = "p.title";
        break;
      case "sort":
        $sort_new = "p.id";
        break;
      default:
        $sort_new = "p.description";
        break;
    };

    $isAsc_new = "";
    //isAsc
    switch ($isAsc) {
      case "true":
        $isAsc_new = "ASC";
        break;
      case "false":
        $isAsc_new = "DESC";
        break;
      default:
        $isAsc_new = "ASC";
        break;
    };

    $query =
      "SELECT p.title, p.category, p.url_thumbnail, p.description, u.name
    FROM podcast AS p
    NATURAL JOIN user AS u
    INNER JOIN episode AS e ON p.id_podcast = e.id_podcast
    WHERE (p.title LIKE :search_value
    OR u.name LIKE :search_value)
    GROUP BY p.title
    HAVING :epsCount
    ORDER BY :sort
    ";

    $queryByGenre =
      "SELECT p.title, p.category, p.url_thumbnail, p.description, u.name
    FROM podcast p
    NATURAL JOIN user u
    INNER JOIN episode e ON p.id_podcast = e.id_podcast
    WHERE (p.title LIKE :search_value
    OR u.name LIKE :search_value
    AND p.category = :genre)
    GROUP BY p.title
    HAVING :epsCount
    ORDER BY :sort
    ";

    if ($genre == "") {
      $this->db->query($query);
    } else {
      $this->db->query($queryByGenre);
    }
    $this->db->bind("search_value", '%' . $keyword . '%');
    $this->db->bind("sort", $sort_new . $isAsc_new);
    $this->db->bind("epsCount", $eps_new);
    $this->db->bind("genre", $genre);
    $podcasts = $this->db->fetchAll();

    // var_dump($keyword);
    // var_dump($genre);
    // var_dump($eps);
    // var_dump($sort);
    // var_dump($isAsc);
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
