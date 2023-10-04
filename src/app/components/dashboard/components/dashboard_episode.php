<section class="episode-list">
  <div>
    <?php include(dirname(__DIR__) . "/../tambah_episode_button.php") ?>
  </div>

  <ul>
    <?php foreach ($this->data["episodes"] as $idx => $episode) : ?>
      <li>
        <div>
          <p class="episode-number"><?= $idx+1 ?></p>
          <img src="<?= STORAGE_URL . $episode->url_thumbnail ?>" alt="">
          <p class="b2"><?= $episode->title ?></p>
        </div>

        <div>
          <div>
            <img src="<?= BASE_URL ?>/images/dashboard/edit_icon.svg" alt="">
            <p>Edit</p>
          </div>

          <div>
            <img src="<?= BASE_URL ?>/images/dashboard/trash_icon.svg" alt="">
            <p>Delete</p>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</section>