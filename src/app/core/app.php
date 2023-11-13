<?php

class App
{
  public function handleRequest()
  {
    $url = $this->parseURL();
    $router = new Router();

    $router->get("public/profile", new getProfileController());

    $router->get("public", new AppController());
    $router->get("public/home", new AppController());
    $router->get("public/search", new AppController());
    $router->get("public/library", new AppController());
    $router->get("public/playlist", new AppController());
    $router->get("public/dashboard", new AppController());
    $router->get("public/dashboard-main", new AppController());
    $router->get("public/dashboard-episode", new AppController());
  
    $router->get("public/components/home", new GetHomeController());
    $router->get("public/components/search", new GetSearchController());
    $router->get("public/components/library", new GetLibraryController());
    $router->get("public/components/playlist", new GetPlaylistController());

    // Dashboard page routes
    $router->get("public/components/dashboard", new GetDashboardLayoutController());
    $router->get("public/components/dashboard-main", new GetDashboardLayoutController());
    $router->get("public/components/dashboard-episode", new GetDashboardLayoutController());

    $router->get("public/dashboard/add-episode", new GetAddEpisodeController());
    $router->get("public/dashboard/add-podcast", new GetAddPodcastController());
    $router->get("public/dashboard/edit-episode", new GetEditEpisodeController());
    $router->get("public/dashboard/edit-podcast", new GetEditPodcastController());

    // Dashboard data-fetching routes
    $router->get("public/dashboard/internal/dashboard-main", new GetDashboardMainController());
    $router->get("public/dashboard/internal/dashboard-episode", new GetDashboardEpisodeController());
    $router->post("public/dashboard/add-episode", new PostAddEpisodeController());
    $router->post("public/dashboard/edit-episode", new PostEditEpisodeController());
    $router->get("public/dashboard/user-podcast", new GetUserPodcastController());
    $router->delete("public/dashboard/episode", new DeleteEpisodeController());
    $router->post("public/dashboard/add-podcast", new PostAddPodcastController());
    $router->post("public/dashboard/edit-podcast", new PostEditPodcastController());
    $router->delete("public/dashboard/podcast", new DeletePodcastController());

    $router->get("public/podcast", new GetPodcastPageController());
    $router->post("public/episode/play", new PostPlayEpisodeController());
    $router->post("public/podcast", new PostPodcastPageController());


    $router->post("public/logout", new LogoutController());

    // $router->get("public/home", new GetHomeController());
    // $router->get("public/search", new GetSearchController());
    $router->get("public/login", new GetLoginController());
    $router->post("public/login", new PostLoginController());
    $router->get("public/signup", new GetSignupController());
    $router->post("public/signup", new PostSignupController());
    $router->get("public/library", new GetLibraryController());
    $router->get("public/playlist", new GetPlaylistController());
    $router->post("public/playlist", new PostPlaylistController());

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
