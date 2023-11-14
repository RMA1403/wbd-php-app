<?php

class GetEditEpisodeController
{
  public function call()
  {
    session_start();

    // Unauthenticated access protection
    if (!isset($_SESSION["user_id"])) {
      http_response_code(401);
      header("Location: " . BASE_URL . "/login");

      return;
    }

    // Forbidden access protection
    if (!isset($_SESSION["role_id"]) || !$_SESSION["role_id"]) {
      http_response_code(403);
      header("Location: " . BASE_URL . "/home");

      return;
    }

    require_once __DIR__ . "/../../views/dashboard/dash_form.php";

    $episodeModel = new EpisodeModel();

    $userId = $_SESSION["user_id"];

    $idPodcast = "";
    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else {
      $idPodcast = $_GET["id_podcast"];
    }

    $idEpisode = "";
    $episode = null;
    $resMessage = null;

    if (!isset($_GET["id_episode"])) {
      (new NotFoundController())->call();
      return;
    } else if ($_GET["premium"] == "true") {
      $idEpisode = $_GET["id_episode"];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/episode/" . $idEpisode);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $_ENV["REST_PHP_KEY"],
      ]);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $output = curl_exec($ch);
      curl_close($ch);

      $resMessage = json_decode($output, TRUE)["episode"];
      if (!$resMessage["id_podcast"] || $resMessage["id_podcast"] != $idPodcast) {
        (new NotFoundController())->call();
        return;
      }
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
      "INPUT_FORM_TITLE_TEXT" => $_GET["premium"] == "true" ? $resMessage["title"] : $episode->title,
      "INPUT_FORM_DESCRIPTION_TEXT" => $_GET["premium"] == "true" ? $resMessage["description"] : $episode->description,
      "INPUT_FORM_TYPE" => "edit-episode",
      "INPUT_FORM_IS_PREMIUM" => $_GET["premium"],
      "url_thumbnail" => $_GET["premium"] == "true" ? $resMessage["url_thumbnail"] : $episode->url_thumbnail,
      "id_user" => $userId,
      "id_podcast" => $idPodcast,
    ];

    $view = new DashboardFormView($data);
    $view->render();
  }
}
