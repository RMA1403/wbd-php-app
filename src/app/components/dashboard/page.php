<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/dashboard_main.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/button.css">
  <title>Main Dashboard</title>
</head>

<body>
  <nav class="navbar"></nav>

  <main>
    <div class="dashboard-content">
      <!-- Podcast Cards -->
      <div class="podcast-card">
        <div class="card-header-container">
          <img class="podcast-thumbnail-img" src="<?= STORAGE_URL . ($this->data["podcast"]->url_thumbnail ?? "") ?>" alt="">

          <div class="podcast-description">
            <div class="podcast-category">
              <p><?= $this->data["podcast"]->category ?? "" ?></p>
            </div>

            <h3><?= $this->data["podcast"]->title ?? "" ?></h3>
            <p class="b5"><?= $this->data["podcast"]->description ?? "" ?></p>
          </div>
        </div>

        <div class="button-container">
          <?php include(dirname(__DIR__) . "/tambah_episode_button.php") ?>

          <a href="/public/dashboard/edit-podcast">
            <button class="edit-button">
              <img src="<?= BASE_URL ?>/images/dashboard/edit_icon.svg" alt="" />

              <p>Edit</p>
            </button>
          </a>
        </div>
      </div>

      <!-- Episodes list -->
      <div class="episodes-container">
        <p class="sh4">Terakhir Diupload</p>

        <ul>
          <?php foreach ($this->data["episodes"] as $episode) : ?>
            <li>
              <img src="<?= STORAGE_URL . $episode->url_thumbnail ?>" alt="" />

              <div>
                <p class="sh5"><?= $episode->title ?></p>
                <p><?= $episode->title ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>

        <a href="/public/dashboard/episodes">
          <p class="sh5">Lihat Semua Episode</p>
          <img src="<?= BASE_URL ?>/images/dashboard/right_arrow.svg" alt="">
        </a>
      </div>
    </div>
  </main>
</body>

</html>