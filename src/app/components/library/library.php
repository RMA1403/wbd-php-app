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
    <button class="new-playlist-btn">New Playlist</button>
    
    <main id="blur">
        <div class="playlist-container">
            <?php include(dirname(__DIR__) . "/library/playlist.php")?>
        </div>
    </main>    

    <div class="wrapper" id="popup">
        <form id="add-playlist-form" autocomplete="off"> 
    
            <h2>Add New Playlist</h2>                               
            <div class="input-box">
                <input type="text" placeholder="Playlist Title" id="playlist-title" required>
                <p id="playlist-title-alert" class="alert-hide"></p>
            </div>

            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
</html>