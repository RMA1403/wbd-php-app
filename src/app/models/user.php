<?php

class UserModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUserInfo($userId)
  {
    $query = "
      SELECT * FROM user
      WHERE id_user = :user_id
    ";

    $this->db->query($query);
    $this->db->bind("user_id", $userId);
    $user = $this->db->fetch();

    return $user;
  }

  public function getAllUsers()
  {
    $query = "SELECT * from user";

    $this->db->query($query);
    $users = $this->db->fetchAll();

    return $users;
  }

  public function insertUser($fullname, $username, $password, $isAdmin)
  { 
    $url_profpic = NULL;
    $query = "INSERT INTO user( name, username, password, url_profpic, is_admin)
              VALUES
              (:fullname, :username, :password, :url_profpic, :isAdmin)";

    $this->db->query($query);
    $this->db->bind('fullname', $fullname);
    $this->db->bind('username', $username);
    $this->db->bind('password', $password);
    $this->db->bind('url_profpic', $url_profpic);
    $this->db->bind('isAdmin', $isAdmin);

    $user = $this->db->execute();

    $rowAffected = $this->db->rowCount();

    return $rowAffected;
  }
}
