<?php

class GetAddEpisodeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/add_episode.php";

    $data = [
      "FE_FORM_TITLE" => "Create New Episode",
      "FE_SHOW_AUDIO_INPUT" => true,
      "FE_FORM_COVER_TEXT" => "Episode Cover",
      "FE_FORM_SUBMIT_TEXT" => "Save Episode"
    ];

    $view = new DashboardAddEpisodeView($data);
    $view->render();
  }
}
