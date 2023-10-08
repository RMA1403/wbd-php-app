<?php

class GetAddEpisodeController
{
  public function call()
  {
    session_start();
    if (!isset($_SESSION["user_id"])) {
      http_response_code(403);
      header("Location: " . BASE_URL . "/login");

      return;
    }

    require_once __DIR__ . "/../../views/dashboard/episode_form.php";

    $userId = $_SESSION["user_id"];

    $idPodcast = "";
    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $idPodcast = $_GET["id_podcast"];
    }

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
      "categories" => ["horror", "comedy", "mystery", "drama"],
      "id_user" => $userId,
      "id_podcast" => $idPodcast,
    ];

    $view = new DashboardEpisodeFormView($data);
    $view->render();
  }
}
