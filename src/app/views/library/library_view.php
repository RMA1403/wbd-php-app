<?php

class LibraryView
{
  public $data;

  public function __construct($data = [])
  {
    $this->data = $data;
  }

  public function render()
  {
    require_once __DIR__ . "/../../components/library/library.php";
  }

  public function render_playlist()
  {
    require_once __DIR__ . "/../../components/library/playlist.php";
  }
}
