<?php

class GetDashboardLayoutController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/layout.php";

    if (!isset($_GET["id_user"])) {
      (new NotFoundController())->call();
      return;
    } 

    $data = [
      // "url_thumbnail" => $episodes[0]->url_thumbnail ?? ""
    ];

    $view = new DashboardLayoutView($data);
    $view->render();
  }
}
