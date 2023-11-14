<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/library/library.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
                <i class='bx bx-trash' data-id="<?=$playlist["id_playlist"]?>"></i>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <h5>
        you don't have any playlist.
    </h5>
<?php endif;?>