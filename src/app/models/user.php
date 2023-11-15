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

  public function getUser($username)
  {
    $query = "
      SELECT * FROM user
      WHERE username = :username
    ";

    $this->db->query($query);
    $this->db->bind("username", $username);
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
    $url_profpic = "/images/default-profpic.jpeg";
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

  public function updateProfile($id_user, $name, $username) {
    $query = "UPDATE user
              SET name=:name, username=:username
              WHERE id_user=:id_user";

    $this->db->query($query);
    $this->db->bind('name', $name);
    $this->db->bind('username', $username);
    $this->db->bind('id_user', $id_user);

    $status = 200;
    try {
      $user = $this->db->execute();
    } catch (PDOException $e) {
      $status = 500;
    }

    return $status;
  }
}
