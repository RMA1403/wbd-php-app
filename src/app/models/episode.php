<?php

class EpisodeModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getTopThreeEpisodes($podcast_id)
  {
    $query = "
      SELECT * FROM episode 
      WHERE id_podcast = :podcast_id
      LIMIT 3
    ";

    $this->db->query($query);
    $this->db->bind("podcast_id", $podcast_id);
    $episodes = $this->db->fetchAll();

    return $episodes;
  }

  public function getPodcastEpisodes($podcast_id, $page)
  {
    $query = "
      SELECT * FROM episode
      WHERE id_podcast = :podcast_id
      ORDER BY id_episode
      LIMIT 4
      OFFSET :offset
    ";

    $this->db->query($query);
    $this->db->bind("podcast_id", $podcast_id);
    $this->db->bind("offset", ($page - 1) * 4);
    $episodes = $this->db->fetchAll();
    
    return $episodes;
  }

  public function getAllPodcastEpisodes($podcast_id)
  {
    $query = "
      SELECT * FROM episode
      WHERE id_podcast = :podcast_id
    ";

    $this->db->query($query);
    $this->db->bind("podcast_id", $podcast_id);
    $episodes = $this->db->fetchAll();

    return $episodes;
  }

  public function saveEpisode($id_podcast, $title, $description, $image_url, $audio_url)
  {
    $query = "
      INSERT INTO episode (title, description, url_thumbnail, url_audio, id_podcast)
      VALUES (:title, :description, :url_thumbnail, :url_audio, :id_podcast)
    ";

    $this->db->query($query);
    $this->db->bind("title", $title);
    $this->db->bind("description", $description);
    $this->db->bind("url_thumbnail", $image_url);
    $this->db->bind("url_audio", $audio_url);
    $this->db->bind("id_podcast", $id_podcast);

    $this->db->execute();
  }

  public function getById($idEpisode)
  {
    $query = "
      SELECT * FROM episode
      WHERE id_episode = :id_episode
    ";

    $this->db->query($query);
    $this->db->bind("id_episode",  $idEpisode);
    $episode = $this->db->fetch();

    return $episode;
  }

  public function updateEpisode($id_episode, $title, $description, $image_url)
  {
    $query = "
      UPDATE episode
      SET title=:title, description=:description, url_thumbnail=:url_thumbnail
      WHERE id_episode=:id_episode
    ";

    $this->db->query($query);
    $this->db->bind("title", $title);
    $this->db->bind("description", $description);
    $this->db->bind("url_thumbnail", $image_url);
    $this->db->bind("id_episode", $id_episode);

    $this->db->execute();
  }

  public function deleteEpisode($idEpisode)
  {
    $query = "
      DELETE FROM episode
      WHERE id_episode = :idEpisode
    ";

    $this->db->query($query);
    $this->db->bind("idEpisode", $idEpisode);

    $this->db->execute();
  }

  public function getByPodcastId($idPodcast)
  {
    $query = "
      SELECT * FROM episode
      WHERE id_podcast = :idPodcast
    ";

    $this->db->query($query);
    $this->db->bind("idPodcast", $idPodcast);
    $episode = $this->db->fetchAll();
    return $episode;
  }
}
