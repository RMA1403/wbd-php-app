<?php

class App
{
  public function handleRequest()
  {
    $url = $this->parseURL();
    $router = new Router();

    // Pages routes
    $router->get("public/login", new GetLoginController());
    $router->get("public/signup", new GetSignupController());
    $router->get("public/profile", new GetProfileController());

    $router->get("public", new AppController());
    $router->get("public/home", new AppController());
    $router->get("public/search", new AppController());
    $router->get("public/library", new AppController());
    $router->get("public/playlist", new AppController());
    $router->get("public/profile", new getProfileController());
    $router->get("public/podcast", new AppController());
    $router->get("public/playlist", new GetPlaylistController());

    $router->get("public/dashboard", new AppController());
    $router->get("public/dashboard-main", new AppController());
    $router->get("public/dashboard-episode", new AppController());
    $router->get("public/dashboard/add-episode", new GetAddEpisodeController());
    $router->get("public/dashboard/add-podcast", new GetAddPodcastController());
    $router->get("public/dashboard/edit-episode", new GetEditEpisodeController());
    $router->get("public/dashboard/edit-podcast", new GetEditPodcastController());

    // Component routes for SPA
    $router->get("public/components/home", new GetHomeController());
    $router->get("public/components/search", new GetSearchController());
    $router->get("public/components/library", new GetLibraryController());
    $router->get("public/components/playlist", new GetPlaylistController());
    $router->get("public/components/dashboard", new GetDashboardLayoutController());
    $router->get("public/components/podcast", new GetPodcastPageController());

    $router->get("public/components/dashboard-main", new GetDashboardLayoutController());
    $router->get("public/components/dashboard-episode", new GetDashboardLayoutController());
    $router->get("public/dashboard/internal/dashboard-main", new GetDashboardMainController());
    $router->get("public/dashboard/internal/dashboard-episode", new GetDashboardEpisodeController());

    // GET routes
    $router->get("public/dashboard/user-podcast", new GetUserPodcastController());
    $router->get("public/components/player", new MountPlayerController());
    $router->get("public/player/episode", new GetEpisodePlayed());

    $router->get("public/podcast-by-id", new GetPodcastController());
    $router->get("public/episode-by-id", new GetEpisodeController());
    $router->get("public/random-podcast", new GetRandomPodcastController());

    $router->get("public/rest/search/podcast", new GetSearchPodcastRestController());
    $router->get("public/rest/search/episode", new GetSearchEpisodeRestController());

    // POST routes
    $router->post("public/logout", new LogoutController());
    $router->post("public/login", new PostLoginController());
    $router->post("public/signup", new PostSignupController());

    $router->post("public/episode/play", new PostPlayEpisodeController());
    $router->post("public/podcast", new PostPodcastPageController());
    $router->post("public/playlist", new PostPlaylistController());
    $router->post("public/profile", new UpdateProfileController());

    $router->post("public/dashboard/add-episode", new PostAddEpisodeController());
    $router->post("public/dashboard/edit-episode", new PostEditEpisodeController());
    $router->post("public/dashboard/add-podcast", new PostAddPodcastController());
    $router->post("public/dashboard/edit-podcast", new PostEditPodcastController());
    $router->post("public/subscribe", new PostSubscribeController());

    $router->post("public/seed", new PostSeedController());

    // DELETE routes
    $router->delete("public/dashboard/episode", new DeleteEpisodeController());
    $router->delete("public/dashboard/podcast", new DeletePodcastController());

    // $router->get("public/library", new GetLibraryController());

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
