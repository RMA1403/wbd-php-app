<?php

class GetDashboardEpisodeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/dashboard_episode.php";

    $view = new DashboardEpisodeView([]);
    $view->render();
  }
}
