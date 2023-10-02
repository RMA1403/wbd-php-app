<?php

define("HTTP_METHODS", ["GET", "POST", "PUT", "DELETE"]);

class Router
{
  private $routes = [];

  public function __construct()
  {
    foreach (HTTP_METHODS as $method) {
      $this->routes[$method] = [];
    }
  }

  public function get($url, $controller)
  {
    $this->routes["GET"][$url] = $controller;
  }

  public function post($url, $controller)
  {
    $this->routes["POST"][$url] = $controller;
  }

  public function put($url, $controller)
  {
    $this->routes["PUT"][$url] = $controller;
  }

  public function delete($url, $controller)
  {
    $this->routes["DELETE"][$url] = $controller;
  }

  public function directRequest($url)
  {
    $controller = new notFoundController();

    $method = $_SERVER["REQUEST_METHOD"];
    if (array_key_exists($url, $this->routes[$method])) {
      $controller = $this->routes[$method][$url];
    }

    if (method_exists($controller, "call")) {
      $controller->call();
    }
  }
}
