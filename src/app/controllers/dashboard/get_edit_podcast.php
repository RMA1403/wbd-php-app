<?php

class GetEditPodcastController
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

    $podcastModel = new PodcastModel();

    $userId = $_SESSION["user_id"];

    $idPodcast = "";
    $podcast = null;
    $resMessage = null;

    if (!isset($_GET["id_podcast"])) {
      (new NotFoundController())->call();
      return;
    } else if ($_GET["premium"] == "true") {
      $idPodcast = $_GET["id_podcast"];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://tubes-rest-service:3000/podcast/" . $idPodcast);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "apikey: " . $_ENV["REST_PHP_KEY"],
      ]);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      $output = curl_exec($ch);
      curl_close($ch);

      $resMessage = json_decode($output, TRUE)["podcast"];
      if (!$resMessage["id_user"] || $resMessage["id_user"] != $_SESSION["user_id"]) {
        (new NotFoundController())->call();
        return;
      }
    } else {
      $idPodcast = $_GET["id_podcast"];

      $podcast = $podcastModel->getById($idPodcast);
      if (!$podcast || $podcast->id_user != $_SESSION["user_id"]) {
        (new NotFoundController())->call();
        return;
      }
    }

    $data = [
      "INPUT_FORM_TITLE" => "Edit Podcast",
      "INPUT_FORM_COVER_TEXT" => "Episode Cover",
      "INPUT_FORM_SUBMIT_TEXT" => "Save Podcast",
      "INPUT_FORM_TITLE_TEXT" => $_GET["premium"] == "true" ? $resMessage["title"] : $podcast->title,
      "INPUT_FORM_DELETE_TEXT" => "Hapus Podcast",
      "INPUT_FORM_DESCRIPTION_TEXT" => $_GET["premium"] == "true" ? $resMessage["description"] : $podcast->description,
      "INPUT_FORM_TYPE" => "edit-podcast",
      "INPUT_FORM_IS_PREMIUM" => $_GET["premium"],
      "url_thumbnail" => $_GET["premium"] == "true" ? $resMessage["url_thumbnail"] : $podcast->url_thumbnail,
      "id_user" => $userId,
      "id_podcast" => $idPodcast,
    ];

    $view = new DashboardFormView($data);
    $view->render();
  }
}
