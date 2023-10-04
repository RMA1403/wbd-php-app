<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/home/home_style.css">
    <title>Homepage</title>
</head>
<body>
    <?php include(dirname(__DIR__) . "/common/sidebar.php")?>
    <?php if (!isset($this->data["username"])) : ?>
        <div class="profile-section login-button">
            <h5>LOGIN</h5>
        </div>
    <?php else:?>
        <div class="profile-section profile" >
            <img class="profpic" src="<?= STORAGE_URL . $this->data["url_profpic"] ?>" alt="image" width="110" height="110">        
            <div class="sh3"><?= substr($this->data["name"], 0, 10) ?></div>
        </div>
    <?php endif;?>
    <main>
        <div class="main-content">
            <h1>Welcome to Spotify!</h1>
            <!-- Main content of the homepage goes here -->
            <div class="audio-player">
                <h2>Now Playing</h2>
            </div>
        </div>
    </main>
    <?php include(dirname(__DIR__) . "/common/player.php")?>
</body>
</html>