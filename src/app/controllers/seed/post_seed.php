<?php
ini_set('max_execution_time', 300);

class PostSeedController
{
  public function call()
  {
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    $dsn = 'mysql:host=' . $_ENV["MYSQL_HOST"] . ';port=' . $_ENV["MYSQL_PORT"] . ';dbname=' . $_ENV["MYSQL_DATABASE"];
    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $db_conn = null;
    try {
      $db_conn = new PDO($dsn, $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], $option);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    // Construct database queries
    $user_query = "INSERT INTO user(name, username, password, url_profpic, is_admin) VALUES ";
    $podcast_query = "INSERT INTO podcast(title, url_thumbnail, description, category, id_user) VALUES ";
    $episode_query = "INSERT INTO episode(title, url_thumbnail, description, url_audio, id_podcast) VALUES ";
    $playlist_query = "INSERT INTO playlist(title, id_user) VALUES ";
    $podcast_playlist_query = "INSERT INTO podcast_x_playlist(id_playlist, id_podcast) VALUES ";

    // Seed users
    for ($i = 1; $i <= 1000; $i++) {
      $name = "User " . $i;
      $username = "user" . $i;
      $password = password_hash("password" . $i, PASSWORD_DEFAULT);
      $url_profpic = $i % 2 == 0 ? "/images/escape.jpg" : "/images/hello.jpg";
      $is_admin = $i <= 100 ? 1 : 0;

      $user_query .= "('" . $name . "', '" . $username . "', '" . $password . "', '" . $url_profpic . "', " . $is_admin . ")";

      if ($i < 1000) {
        $user_query .= ", ";
      }
    }

    // Seed podcasts
    for ($i = 1; $i <= 1000; $i++) {
      $title = "Podcast Non-Premium " . $i;
      $description = "Description for Podcast Non-Premium " . $i . " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erat lacus, cursus vel arcu ut, blandit euismod ex. Pellentesque eu magna vehicula odio laoreet maximus eget eu neque. Nullam nec euismod arcu, id tincidunt magna.";
      $url_thumbnail = $i % 2 == 0 ? "/images/escape.jpg" : "/images/hello.jpg";
      $category = $i % 3 == 0 ? "technology" : ($i % 3 == 1 ? "horror" : "comedy");
      $id_user = ($i % 100) + 1;

      $podcast_query .= "('" . $title . "', '" . $url_thumbnail . "', '" . $description . "', '" . $category . "', " . $id_user . ")";

      if ($i < 1000) {
        $podcast_query .= ", ";
      }

      // Seed episodes
      for ($j = 1; $j <= 15; $j++) {
        $eps_title = "Episode " . $j . " of Podcast Non-Premium " . $i;
        $eps_description = "Description for Episode " . $j . " of Podcast Non-Premium " . $i . " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erat lacus, cursus vel arcu ut, blandit euismod ex. Pellentesque eu magna vehicula odio laoreet maximus eget eu neque. Nullam nec euismod arcu, id tincidunt magna.";
        $eps_url_thumbnail = $j % 2 == 0 ? "/images/escape.jpg" : "/images/hello.jpg";
        $eps_url_audio = $j % 2 == 0 ? "/audio/audiotester.mp3" : "/audio/sample.mp3";

        $episode_query .= "('" . $eps_title . "', '" . $eps_url_thumbnail . "', '" . $eps_description . "', '" . $eps_url_audio . "', " . $i . ")";

        if ($i < 1000 || $j < 15) {
          $episode_query .= ", ";
        }
      }
    }

    // Seed playlists
    for ($i = 1; $i <= 100; $i++) {
      $title = "Playlist " . $i;
      $id_user = 101 + ($i % 100);

      $playlist_query .= "('" . $title . "', " . $id_user . ")";

      for ($j = 0; $j < 4; $j++) {
        $podcast_playlist_query .= "('" . $i . "', " . $i + $j . ")";
        if ($i < 100 || $j < 3) {
          $podcast_playlist_query .= ", ";
        }
      }

      if ($i < 100) {
        $playlist_query .= ", ";
      }
    }

    // Execute database queries
    $db_conn->query($user_query);
    $db_conn->query($podcast_query);
    $db_conn->query($episode_query);
    $db_conn->query($playlist_query);
    $db_conn->query($podcast_playlist_query);

    echo json_encode(["message" => "successx"]);
  }
}
