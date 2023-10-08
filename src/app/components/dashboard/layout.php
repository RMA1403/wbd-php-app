<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/layout.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/pages/main.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/pages/episode.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/components/button.css">

  <script type="module" src="<?= BASE_URL ?>/javascript/dashboard/layout.js" defer></script>
  <script type="module" src="<?= BASE_URL ?>/javascript/toast.mjs" defer></script>
  <title>Main Dashboard</title>
</head>

<body>
  <?php include(dirname(__DIR__) . "/common/sidebar.php") ?>
  <?php include(dirname(__DIR__) . "/common/toast.php") ?>

  <div id="overlay-layout" class="overlay hidden"></div>

  <main>
    <div class="dashboard-nav">
      <div>
        <p id="dashboard-link" class="sh4">Dashboard</p>
        <p id="episode-link" class="sh4">Episode</p>
      </div>

      <div class="choose-container">
        <button id="choose-podcast-btn" class="">
          <p class="b3">Choose Podcast</p>
        </button>

        <ul id="podcast-choices" class="hidden">
          <?php foreach ($this->data["podcasts"] as $podcast) : ?>
            <li>
              <a href="/public/dashboard/main?id_podcast=<?= $podcast->id_podcast ?>">
                <p class="b3"><?= $podcast->title ?></p>
              </a>
            </li>
          <?php endforeach; ?>
          <li>
            <a href="/public/dashboard/add-podcast">
              <p class="b3">Add Podcast</p>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="dashboard-nav-line"></div>

    <section id="dashboard-section"></section>
  </main>

  <?php include(dirname(__DIR__) . "/common/player.php") ?>
</body>

</html>