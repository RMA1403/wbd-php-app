<section class="episode-list">
  <div>
    <?php include(dirname(__DIR__) . "/components/tambah_episode_button.php") ?>
  </div>

  <ul>
    <?php foreach ($this->data["premium_episodes"] as $idx => $episode) : ?>
      <li>
        <div>
          <p class="episode-number"><?= $idx + 1 + (($this->data["page"] - 1) * 4) ?></p>
          <img width="75" height="75" src="http://localhost:3000/images/<?= $episode["url_thumbnail"] ?>" alt="">
          <p class="b2"><?= $episode["title"] ?></p>
        </div>

        <div>
          <a href="<?= BASE_URL ?>/dashboard/edit-episode?id_podcast=<?= $this->data["id_podcast"] ?? "" ?>&id_episode=<?= $episode["id_episode"] ?>&premium=true">
            <div>
              <img width="16" height="16" src="<?= BASE_URL ?>/images/dashboard/edit_icon.svg" alt="">
              <p>Edit</p>
            </div>
          </a>

          <button data-id="<?= $episode["id_episode"] ?>" class="delete-episode-btn">
            <div>
              <img width="16" height="18" src="<?= BASE_URL ?>/images/dashboard/trash_icon.svg" alt="">
              <p>Delete</p>
            </div>
          </button>
        </div>
      </li>
    <?php endforeach; ?>
    <?php foreach ($this->data["episodes"] as $idx => $episode) : ?>
      <li>
        <div>
          <p class="episode-number"><?= $idx + 1 + count($this->data["premium_episodes"]) + (($this->data["page"] - 1) * 4) ?></p>
          <img width="75" height="75" src="<?= STORAGE_URL . $episode->url_thumbnail ?>" alt="">
          <p class="b2"><?= $episode->title ?></p>
        </div>

        <div>
          <a href="<?= BASE_URL ?>/dashboard/edit-episode?id_podcast=<?= $this->data["id_podcast"] ?? "" ?>&id_episode=<?= $episode->id_episode ?>&premium=false">
            <div>
              <img width="16" height="16" src="<?= BASE_URL ?>/images/dashboard/edit_icon.svg" alt="">
              <p>Edit</p>
            </div>
          </a>

          <button data-id="<?= $episode->id_episode ?>" class="delete-episode-btn">
            <div>
              <img width="16" height="18" src="<?= BASE_URL ?>/images/dashboard/trash_icon.svg" alt="">
              <p>Delete</p>
            </div>
          </button>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

  <ul style="display: flex; gap: 8px; justify-content: center">
    <?php foreach ($this->data["page_count"] as $idx => $episode) : ?>
      <li style="padding: 0; border: none;"><a style="padding: 8px; background-color: red" href="<?= BASE_URL ?>/dashboard-episode?id_podcast=<?= $this->data["id_podcast"] ?? "" ?>&page=<?= $idx + 1 ?>"><?= $idx + 1 ?></a></li>
    <?php endforeach; ?>
  </ul>
</section>