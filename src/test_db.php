<?php

// Constants
$host = $_ENV["MYSQL_HOST"];
$port = $_ENV["MYSQL_PORT"];
$db = $_ENV["MYSQL_DATABASE"];
$user = $_ENV["MYSQL_USER"];
$password = $_ENV["MYSQL_PASSWORD"];

// Connect to MySQL database
try {
  $dsn = "mysql:host=$host;port=$port;dbname=$db";
  $option = [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ];

  $pdo = new PDO($dsn, $user, $password, $option);

  if ($pdo) {
    // Successfully connected to database
    echo "Connected to database successfully" . "<br/>";

    $stmt = $pdo->query("SELECT * FROM test_table");
    while ($row = $stmt->fetch()) {
      echo "<h1> Nama: " . $row["nama"] . " | Umur: " . $row["umur"] . "</h1><br/>";
    }
  }
} catch (PDOException $e) {
  die($e->getMessage());
} finally {
  if ($pdo) {
    $pdo = null;
  }
}
