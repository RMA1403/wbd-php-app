<section class="home-section">
        <div class="home-content">
            <?php if (isset($this->data["comedy"])) : ?>
                <h4>comedy</h4>
                <div class="home-podcast-container">
                    <?php foreach ($this->data["comedy"] as $podcast) : ?>
                        <div class="home-podcast-card" data-id-podcast="<?= $podcast->id_podcast?>">
                            <img class="thumbnail" src="<?= STORAGE_URL . $podcast->url_thumbnail ?>" alt="podcast image">
                            <div class="info">
                                <div class="sh5"><?= $podcast->title ?> </div>
                                <div class="b5"><?= $podcast->name ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="home-content">
            <?php if (isset($this->data["tech"])) : ?>
                <h4>technology</h4>
                <div class="home-podcast-container">
                    <?php foreach ($this->data["tech"] as $podcast) : ?>
                        <div class="home-podcast-card" data-id-podcast="<?= $podcast->id_podcast?>">
                            <img class="thumbnail" src="<?= STORAGE_URL . $podcast->url_thumbnail ?>" alt="podcast image">
                            <div class="info">
                                <div class="sh5"><?= $podcast->title ?> </div>
                                <div class="b5"><?= $podcast->name ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="home-content">
            <?php if (isset($this->data["horror"])) : ?>
                <h4>horror</h4>
                <div class="home-podcast-container">
                    <?php foreach ($this->data["horror"] as $podcast) : ?>
                        <div class="home-podcast-card" data-id-podcast="<?= $podcast->id_podcast?>">
                            <img class="thumbnail" src="<?= STORAGE_URL . $podcast->url_thumbnail ?>" alt="podcast image">
                            <div class="info">
                                <div class="sh5"><?= $podcast->title ?> </div>
                                <div class="b5"><?= $podcast->name ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
</section>