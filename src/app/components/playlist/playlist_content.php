<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/library/library.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
                <i class='bx bx-trash' data-id="<?=$podcast["id_podcast"]?>"></i>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <h5>
        your playlist is empty.
    </h5>
<?php endif;?>

<script type="module" src="<?= BASE_URL ?>/javascript/library/library.js" defer> </script>
