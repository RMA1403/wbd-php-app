<?php

class DashboardEpisodeFormView
{
  public $data;

  public function __construct($data = [])
  {
    $this->data = $data;
  }

  public function render()
  {
    require_once __DIR__ . "/../../components/dashboard/pages/episode_form.php";
  }
}
