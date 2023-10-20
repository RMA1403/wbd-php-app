<?php

class GetDashboardLayoutController
{
  public function call()
  {
    session_start();

    // Unauthenticated access protection
    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      header("Location: " . BASE_URL . "/login");

      return;
    }

    // Forbidden access protection
    if (!isset($_SESSION["role_id"]) || !$_SESSION["role_id"]) {
      http_response_code(403);
      header("Location: " . BASE_URL . "/home");

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
