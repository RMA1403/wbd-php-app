<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/library/library.css">

<?php if (!empty($this->data)): ?>
    <div class="user-playlist">
        <?php foreach ($this->data as $podcast): ?>
            <div class="playlist">
                <img class="thumbnail" src="<?= STORAGE_URL . $podcast['url_thumbnail'] ?>" alt="image">
                <div class="info">
                    <div class="sh5"><?=$playlist['title']?> </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <h5>
        no results found.
    </h5>
<?php endif;?>