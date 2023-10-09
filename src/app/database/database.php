<?php

class Database
{
  private $db_connection;
  private $statement;

  public function __construct()
  {
    $dsn = 'mysql:host=' . $_ENV["MYSQL_HOST"] . ';port=' . $_ENV["MYSQL_PORT"] . ';dbname=' . $_ENV["MYSQL_DATABASE"];
    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->db_connection = new PDO($dsn, $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], $option);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function query($query)
  {
    try {
      $this->statement = $this->db_connection->prepare($query);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function bind($param, $value, $type = null)
  {
    try {
      if (is_null($type)) {
        if (is_int($value)) {
          $type = PDO::PARAM_INT;
        } else if (is_bool($value)) {
          $type = PDO::PARAM_BOOL;
        } else if (is_null($value)) {
          $type = PDO::PARAM_NULL;
        } else {
          $type = PDO::PARAM_STR;
        }
      }
      $this->statement->bindValue($param, $value, $type);
      print_r($type);
      // print_r($this->statement);
    } catch (PDOException $e) {
      
      die($e->getMessage());
    }
  }

  public function execute()
  {
    try {
      $this->statement->execute();
    } catch (PDOException $e) {
      $sqlState = '23000';
      $customMessage = 'Integrity constraint violation: 1062 Duplicate entry for key user.username';
      if($e->getCode() == 23000){
        throw new PDOException($customMessage, $sqlState);
      }
    }
  }

  public function fetch()
  {
    try {
      $this->execute();
      return $this->statement->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function fetchAll()
  {
    try {
      $this->execute();
      var_dump($this->statement);
      var_dump($this->statement->fetchAll(PDO::FETCH_OBJ));
      return $this->statement->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function rowCount()
  {
    try {
      return $this->statement->rowCount();
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function lastInsertID()
  {
    try {
      return $this->db_connection->lastInsertId();
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
}
