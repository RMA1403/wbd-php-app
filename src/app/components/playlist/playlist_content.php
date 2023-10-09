<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/library/library.css">

<?php if (!empty($this->data)): ?>
    <div class="user-playlist">
        <?php foreach ($this->data as $podcast): ?>
            <div class="playlist">
                <a href="<?= BASE_URL . "/podcast?id_podcast=" . $podcast['id_podcast']?>">
                    <img class="thumbnail" src="<?= STORAGE_URL . $podcast['url_thumbnail'] ?>" alt="image">
                </a>
                <div class="info">
                    <div class="sh5"><?=$podcast['title']?> </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <h5>
        your playlist is empty.
    </h5>
<?php endif;?>