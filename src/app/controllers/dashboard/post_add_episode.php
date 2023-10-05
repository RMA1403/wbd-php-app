<?php

class PostAddEpisodeController
{
  public function call()
  {
    $mimeType = mime_content_type($_FILES["audioFile"]["tmp_name"]);
    $fileName = md5(uniqid(mt_rand(), true) . $mimeType);
    move_uploaded_file($_FILES["audioFile"]["tmp_name"], __DIR__ . "/../../storage/episodes/" . $fileName . ".mp3");
    echo "success";
  }
}
