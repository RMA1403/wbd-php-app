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
}
