<?php

class GetEditPodcastController
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
    
    $idPodcast = "";
    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $idPodcast = $_GET["id_podcast"];
    }
    
    $podcastModel = new PodcastModel();
    $podcast = $podcastModel->getById($idPodcast);
    if (!$podcast || $podcast->id_podcast != $idPodcast) {
      (new NotFoundController())->call();
      return;
    }

    $data = [
      "INPUT_FORM_TITLE" => "Edit Podcast",
      "INPUT_FORM_COVER_TEXT" => "Episode Cover",
      "INPUT_FORM_SUBMIT_TEXT" => "Save Podcast",
      "INPUT_FORM_TITLE_TEXT" => $podcast->title ?? "",
      "INPUT_FORM_DELETE_TEXT" => "Hapus Podcast",
      "INPUT_FORM_DESCRIPTION_TEXT" => $podcast->description ?? "",
      "INPUT_FORM_TYPE" => "edit-podcast",
      "url_thumbnail" => $podcast->url_thumbnail ?? "",
      "id_user" => $userId,
      "id_podcast" => $idPodcast,
    ];

    $view = new DashboardFormView($data);
    $view->render();
  }
}
