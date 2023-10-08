<?php

class GetDashboardLayoutController
{
  public function call()
  {
    session_start();
    if (!isset($_SESSION["user_id"])) {
      http_response_code(403);
      header("Location: " . BASE_URL . "/login");

      return;
    }

    require_once __DIR__ . "/../../views/dashboard/layout.php";

    $podcastModel = new PodcastModel();
    $podcasts = $podcastModel->getUserPodcasts($_SESSION["user_id"]) ?? [];

    $data = [
      "podcasts" => $podcasts
    ];

    $view = new DashboardLayoutView($data);
    $view->render();
  }
}
