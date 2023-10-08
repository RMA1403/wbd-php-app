<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/podcast/style.css">
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/podcast/script.js" defer>
  </script>
  <title>Main Dashboard</title>
</head>

<body>
  <?php include(dirname(__DIR__) . "/common/sidebar.php") ?>
  <?php include(dirname(__DIR__) . "/common/toast.php") ?>

  <main>
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
    </div>

    <ul class="episode-list">
      <?php foreach ($this->data["episodes"] as $idx => $episode) : ?>
        <li>
          <div>
            <p class="episode-number"><?= $idx + 1 ?></p>
            <img src="<?= STORAGE_URL . $episode->url_thumbnail ?>" alt="">
            <p class="b2"><?= $episode->title ?></p>
          </div>

          <div>
            <button data-id="<?= $episode->id_episode ?>" class="play-button">
              <img src="<?= BASE_URL ?>/images/assets/play_icon.svg" alt="pause">
            </button>
            <!-- <a href="<?= BASE_URL ?>/dashboard/edit-episode?id_podcast=<?= $this->data["id_podcast"] ?? "" ?>&id_episode=<?= $episode->id_episode ?>">
              <div>
                <img src="<?= BASE_URL ?>/images/dashboard/edit_icon.svg" alt="">
                <p>Edit</p>
              </div>
            </a>

            <button data-id="<?= $episode->id_episode ?>" class="delete-episode-btn">
              <div>
                <img src="<?= BASE_URL ?>/images/dashboard/trash_icon.svg" alt="">
                <p>Delete</p>
              </div>
            </button> -->
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </main>

  <?php include(dirname(__DIR__) . "/common/player.php") ?>
</body>

</html>