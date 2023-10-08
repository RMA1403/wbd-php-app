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

    $data = [
      // "url_thumbnail" => $episodes[0]->url_thumbnail ?? ""
    ];

    $view = new DashboardLayoutView($data);
    $view->render();
  }
}
