<?php

class UserModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUserPodcasts($userId)
  {
    $query = "
      SELECT * FROM user
      WHERE id_user = :user_id
    ";

    $this->db->query($query);
    $this->db->bind("user_id", $userId);
    $podcasts = $this->db->fetchAll();

    return $podcasts;
  }
}
