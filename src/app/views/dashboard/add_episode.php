<?php

class DashboardAddEpisodeView
{
  public $data;

  public function __construct($data = [])
  {
    $this->data = $data;
  }

  public function render()
  {
    require_once __DIR__ . "/../../components/dashboard/pages/add_episode.php";
  }
}
