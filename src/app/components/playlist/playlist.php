<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/library/library.css">
    <script type="module" src="<?= BASE_URL ?>/javascript/library/library.js" defer> </script>
    
    <title>Playlist</title>
</head>
<body>
    <?php include(dirname(__DIR__) . "/common/sidebar.php")?>
    <?php include(dirname(__DIR__) . "/common/profile.php")?>

    
    <main>
        <div class="playlist-container" data-id="<?=$_GET["playlist_id"]?>">
            <?php include(dirname(__DIR__) . "/playlist/playlist_content.php")?>
        </div>
    </main>
    <?php include(dirname(__DIR__) . "/common/player.php")?>
</body>
</html>