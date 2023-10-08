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

  public function getPodcastEpisodes($podcast_id)
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

  public function saveEpisode($id_podcast, $title, $description, $image_url, $audio_url) {
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
}
