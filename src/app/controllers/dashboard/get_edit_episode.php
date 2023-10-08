<?php

class GetEditEpisodeController
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

    $episodeModel = new EpisodeModel();

    $userId = "";
    if (!isset($_GET["id_user"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $userId = $_GET["id_user"];
    }

    $idPodcast = "";
    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $idPodcast = $_GET["id_podcast"];
    }

    $idEpisode = "";
    $episode = null;
    if (!isset($_GET["id_episode"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $idEpisode = $_GET["id_episode"];

      $episode = $episodeModel->getById($idEpisode);
      if (!$episode || $episode->id_podcast != $idPodcast) {
        (new NotFoundController())->call();
        return;
      }
    }

    $data = [
      "INPUT_FORM_TITLE" => "Edit Episode",
      "INPUT_FORM_COVER_TEXT" => "Episode Cover",
      "INPUT_FORM_SUBMIT_TEXT" => "Save Episode",
      "INPUT_FORM_TITLE_TEXT" => $episode->title ?? "",
      "INPUT_FORM_DESCRIPTION_TEXT" => $episode->description ?? "",
      "INPUT_FORM_TYPE" => "edit-episode",
      "url_thumbnail" => $episode->url_thumbnail ?? "",
      "id_user" => $userId,
      "id_podcast" => $idPodcast,
    ];

    $view = new DashboardEpisodeFormView($data);
    $view->render();
  }
}
