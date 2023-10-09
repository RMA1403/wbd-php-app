<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/library/library.css">

<?php if (!empty($this->data)): ?>
    <div class="user-playlist">
        <?php foreach ($this->data as $playlist): ?>
            <div class="playlist">
                <a href="<?= BASE_URL . "/playlist?playlist_id=" . $playlist['id_playlist']?>">
                    <img class="thumbnail" src="<?= STORAGE_URL . "/images/placeholder.jpeg" ?>" alt="image">
                </a>
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