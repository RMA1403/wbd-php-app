
<?php if (isset($this->data["podcasts"])): ?>
    <div class="podcast-list">
        <?php foreach ($this->data["podcasts"] as $podcast): ?>
            <div class="podcast-card-result" data-id-podcast="<?= $podcast->id_podcast?>">
                <img class="thumbnail" src="<?= STORAGE_URL . $podcast->url_thumbnail ?>" alt="image">
                <div class="info">
                    <div class="sh5"><?=$podcast->title?> </div>
                    <div class="b5"><?=$podcast->name?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <h5>
        No results found.
    </h5>
<?php endif;?>