<?php

class App
{
  public function handleRequest()
  {
    $url = $this->parseURL();
    $router = new Router();

    $router->get("public/dashboard", new GetDashboard());
    
    $router->directRequest($url);
  }

  private function parseURL()
  {
    $url = trim($_SERVER["REQUEST_URI"], "/");
    $url = filter_var($url, FILTER_SANITIZE_URL);

    $url = parse_url($url);
    // $url["path"] = explode("/", $url["path"]);

    return $url["path"];
  }
}
