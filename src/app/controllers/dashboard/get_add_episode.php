<?php

class GetAddEpisodeController
{
  public function call()
  {
    require_once __DIR__ . "/../../views/dashboard/add_episode.php";

    $data = [
      "INPUT_FORM_TITLE" => "Create New Episode",
      "INPUT_FORM_SHOW_AUDIO_INPUT" => true,
      // "INPUT_FORM_SHOW_CATEGORY_INPUT" => true,
      "INPUT_FORM_COVER_TEXT" => "Episode Cover",
      "INPUT_FORM_SUBMIT_TEXT" => "Save Episode",
      // "INPUT_FORM_DELETE_TEXT" => "Hapus Podcast",
      "INPUT_FORM_TITLE_TEXT" => "Episode title",
      "INPUT_FORM_DESCRIPTION_TEXT" => "Episode description",
      "INPUT_FORM_TYPE" => "add-episode",
      "categories" => ["horror", "comedy", "mystery", "drama"]
    ];

    $view = new DashboardAddEpisodeView($data);
    $view->render();
  }
}
