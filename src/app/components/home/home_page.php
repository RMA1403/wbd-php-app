<section>
    <div class="comedy-content">
        <h4>COMEDY</h4>
        <div class="home-podcast-list">
            <?php if (isset($this->data["tech_podcasts"])) : ?>
                <div class="home-podcast-list">
                    <?php foreach ($this->data["tech_podcasts"] as $podcast) : ?>
                        <div class="podcast">
                            <img class="thumbnail" src="<?= STORAGE_URL . $podcast->url_thumbnail ?>" alt="image">
                            <div class="info">
                                <div class="sh5"><?= $podcast->title ?> </div>
                                <div class="b5"><?= $podcast->name ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="sh4">
                    &nbsp; no results found.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>