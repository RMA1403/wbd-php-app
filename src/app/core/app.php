<?php

class App
{
  public function handleRequest()
  {
    $url = $this->parseURL();
    $router = new Router();

    // Dashboard page routes
    $router->get("public/dashboard", new GetDashboardLayoutController());
    $router->get("public/dashboard/main", new GetDashboardLayoutController());
    $router->get("public/dashboard/episode", new GetDashboardLayoutController());
    $router->get("public/dashboard/add-episode", new GetAddEpisodeController());
    $router->get("public/dashboard/edit-episode", new GetEditEpisodeController());

    // Dashboard data-fetching routes
    $router->get("public/dashboard/internal/main", new GetDashboardMainController());
    $router->get("public/dashboard/internal/episode", new GetDashboardEpisodeController());
    $router->post("public/dashboard/add-episode", new PostAddEpisodeController());
    $router->post("public/dashboard/edit-episode", new PostEditEpisodeController());
    $router->get("public/dashboard/user-podcast", new GetUserPodcastController());
    $router->delete("public/dashboard/episode", new DeleteEpisodeController());

    $router->get("public/home", new GetHomeController());
    $router->get("public/search", new GetSearchController());
    $router->get("public/login", new GetLoginController());
    $router->post("public/login", new PostLoginController());
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
