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
        <?php foreach ($this->data["premium_podcasts"] as $podcast) : ?>
          <li>
            <a href="/public/dashboard-main?id_podcast=<?= $podcast["id_podcast"] ?>&premium=true">
              <p class="b3"><?= $podcast["title"] ?></p>
            </a>
          </li>
        <?php endforeach; ?>
        <?php foreach ($this->data["podcasts"] as $podcast) : ?>
          <li>
            <a href="/public/dashboard-main?id_podcast=<?= $podcast->id_podcast ?>&premium=false">
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