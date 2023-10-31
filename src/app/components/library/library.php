<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/library/library.css">
    <title>Library</title>
</head>
<body>
    <main>
        <div class="playlist-container">
            <?php include(dirname(__DIR__) . "/library/playlist.php")?>
        </div>
    </main>
</body>
</html>