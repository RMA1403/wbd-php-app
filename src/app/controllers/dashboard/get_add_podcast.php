<?php

class GetAddPodcastController
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

    $userId = $_SESSION["user_id"];

    $data = [
      "INPUT_FORM_TITLE" => "Create New Podcast",
      "INPUT_FORM_SHOW_CATEGORY_INPUT" => true,
      "INPUT_FORM_COVER_TEXT" => "Podcast Cover",
      "INPUT_FORM_SUBMIT_TEXT" => "Save Podcast",
      "INPUT_FORM_TITLE_TEXT" => "Podcast title",
      "INPUT_FORM_DESCRIPTION_TEXT" => "Podcast description",
      "INPUT_FORM_TYPE" => "add-podcast",
      "INPUT_FORM_SHOW_PREMIUM_BUTTON" => true,
      "INPUT_FORM_IS_PREMIUM" => "false",
      "categories" => ["comedy", "horror", "technology"],
      "id_user" => $userId,
    ];

    $view = new DashboardFormView($data);
    $view->render();
  }
}
