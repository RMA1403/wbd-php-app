<?php

class App
{
  public function handleRequest()
  {
    $url = $this->parseURL();
    $router = new Router();

    $router->get("public/dashboard", new GetDashboardController());
    $router->get("public/home", new GetHomeController());
    $router->get("public/login", new GetLoginController());
    $router->get("public/signup", new GetSignupController());

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