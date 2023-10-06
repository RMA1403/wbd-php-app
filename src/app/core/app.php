<?php

class App
{
  public function handleRequest()
  {
    $url = $this->parseURL();
    $router = new Router();

    $router->get("public/dashboard", new GetDashboardLayoutController());
    $router->get("public/dashboard/main", new GetDashboardLayoutController());
    $router->get("public/dashboard/episode", new GetDashboardLayoutController());

    $router->get("public/dashboard/internal/main", new GetDashboardMainController());
    $router->get("public/dashboard/internal/episode", new GetDashboardEpisodeController());

    $router->get("public/home", new GetHomeController());
    $router->get("public/search", new GetSearchController());
    $router->get("public/login", new GetLoginController());
    $router->get("public/signup", new GetSignupController());
    $router->post("public/signup", new PostSignupController());

    $router->directRequest($url);
  }

  private function parseURL()
  {
    $url = trim($_SERVER["REQUEST_URI"], "/");
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = parse_url($url);

    return $url["path"];
  }
}