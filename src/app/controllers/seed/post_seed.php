<?php

class PostSeedController
{
  public function call()
  {
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

    $podcast_query = "INSERT INTO podcast(title, url_thumbnail, description, category, id_user) VALUES ";
    $episode_query = "INSERT INTO episode(title, url_thumbnail, description, url_audio, id_podcast) VALUES ";

    for ($i = 0; $i < 1000; $i++) {
      $title = "Podcast Non-Premium " . $i;
      $description = "Description for Podcast Non-Premium " . $i . " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erat lacus, cursus vel arcu ut, blandit euismod ex. Pellentesque eu magna vehicula odio laoreet maximus eget eu neque. Nullam nec euismod arcu, id tincidunt magna.";
      $url_thumbnail = $i % 2 == 0 ? "/images/escape.jpg" : "/images/hello.jpg";
      $category = $i % 3 == 0 ? "technology" : ($i % 3 == 1 ? "horror" : "comedy");

      $podcast_query .= "('" . $title . "', '" . $url_thumbnail . "', '" . $description . "', '" . $category . "', 1)";

      if ($i < 999) {
        $podcast_query .= ", ";
      }

      for ($j = 0; $j < 15; $j++) {
        $eps_title = "Episode " . $j . " of Podcast Non-Premium " . $i;
        $eps_description = "Description for Episode " . $j . " of Podcast Non-Premium " . $i . " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla erat lacus, cursus vel arcu ut, blandit euismod ex. Pellentesque eu magna vehicula odio laoreet maximus eget eu neque. Nullam nec euismod arcu, id tincidunt magna.";
        $eps_url_thumbnail = $j % 2 == 0 ? "/images/escape.jpg" : "/images/hello.jpg";
        $eps_url_audio = $j % 2 == 0 ? "/audio/audiotester.mp3" : "/audio/sample.mp3";

        $episode_query .= "('" . $eps_title . "', '" . $eps_url_thumbnail . "', '" . $eps_description . "', '" . $eps_url_audio . "', " . $i + 1 . ")";

        if ($i < 999 || $j < 14) {
          $episode_query .= ", ";
        }
      }
    }

    $db_conn->query($podcast_query);
    $db_conn->query($episode_query);

    echo json_encode(["message" => $podcast_query]);
  }
}
