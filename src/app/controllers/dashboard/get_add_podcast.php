<?php

class GetAddPodcastController
{
  public function call()
  {
    session_start();
    if (!isset($_SESSION["user_id"])) {
      http_response_code(403);
      header("Location: " . BASE_URL . "/login");

      return;
    }

    require_once __DIR__ . "/../../views/dashboard/dash_form.php";

    $userId = $_SESSION["user_id"];

    $data = [
      "INPUT_FORM_TITLE" => "Create New Podcast",
      // "INPUT_FORM_SHOW_AUDIO_INPUT" => true,
      "INPUT_FORM_SHOW_CATEGORY_INPUT" => true,
      "INPUT_FORM_COVER_TEXT" => "Podcast Cover",
      "INPUT_FORM_SUBMIT_TEXT" => "Save Podcast",
      // "INPUT_FORM_DELETE_TEXT" => "Hapus Podcast",
      "INPUT_FORM_TITLE_TEXT" => "Podcast title",
      "INPUT_FORM_DESCRIPTION_TEXT" => "Podcast description",
      "INPUT_FORM_TYPE" => "add-podcast",
      "categories" => ["comedy", "sports", "technology"],
      "id_user" => $userId,
    ];

    $view = new DashboardFormView($data);
    $view->render();
  }
}
