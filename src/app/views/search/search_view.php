<?php

class SearchView
{
  public $data;

  public function __construct($data = [])
  {
    $this->data = $data;
  }

  public function render()
  {
    require_once __DIR__ . "/../../components/search/search_page.php";
  }
  public function render_match()
  {
    require_once __DIR__ . "/../../components/search/result.php";
  }
}
