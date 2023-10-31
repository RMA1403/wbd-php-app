<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/home/home.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Homepage</title>
</head>
<body>
    <main>
        <div class="comedy-content">
            <h4>COMEDY</h4>
            <div class="podcast-list">
            <?php if (isset($this->data["tech_podcasts"])): ?>
                <div class="podcast-list">
                    <?php foreach ($this->data["tech_podcasts"] as $podcast): ?>
                        <div class="podcast">
                            <img class="thumbnail" src="<?= STORAGE_URL . $podcast->url_thumbnail ?>" alt="image">
                            <div class="info">
                                <div class="sh5"><?=$podcast->title?> </div>
                                <div class="b5"><?=$podcast->name?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="sh4">
                    &nbsp; no results found.
                </div>
            <?php endif;?>
            </div>
        </div>
    </main>
</body>
</html>