<section>
  <div class="dashboard-content">
    <!-- Podcast Cards -->
    <div class="podcast-card">
      <div class="card-header-container">
        <img width="200" height="200" class="podcast-thumbnail-img" src="<?= STORAGE_URL . ($this->data["podcast"]->url_thumbnail ?? "") ?>" alt="">

        <div class="podcast-description">
          <div class="podcast-category">
            <p><?= $this->data["podcast"]->category ?? "" ?></p>
          </div>

          <h3><?= $this->data["podcast"]->title ?? "" ?></h3>
          <p class="b5"><?= $this->data["podcast"]->description ?? "" ?></p>
        </div>
      </div>

      <div class="button-container">
        <?php include(dirname(__DIR__) . "/components/tambah_episode_button.php") ?>

        <a href="/public/dashboard/edit-podcast?id_podcast=<?= $this->data["id_podcast"] ?? "" ?>">
          <button class="edit-button">
            <img src="<?= BASE_URL ?>/images/dashboard/edit_icon.svg" alt="" />

            <p>Edit</p>
          </button>
        </a>
      </div>
    </div>

    <!-- Episodes list -->
    <div class="episodes-container">
      <p class="sh4">Your Episodes</p>

      <ul>
        <?php foreach ($this->data["episodes"] as $episode) : ?>
          <li>
            <img width="49" height="49" src="<?= STORAGE_URL . $episode->url_thumbnail ?>" alt="" />

            <div>
              <p class="sh5"><?= $episode->title ?></p>
              <p><?= $episode->title ?></p>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>

      <button id="all-episode-btn">
        <p class="sh5">Lihat Semua Episode</p>
        <img src="<?= BASE_URL ?>/images/dashboard/right_arrow.svg" alt="">
      </button>
    </div>
  </div>
</section>