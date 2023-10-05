<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/search/search.css">
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/util/debounce.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/search/search.js" defer></script>
    <title>Search Page</title>
</head>
<body>
    <?php include(dirname(__DIR__) . "/common/sidebar.php")?>
    <?php include(dirname(__DIR__) . "/common/profile.php")?>
    <navbar>
        <div class="search-bar">
            <img src="<?= BASE_URL ?>/images/assets/search_icon.svg" alt="home" width="24px" height="24px">
            <input id="search-input" type="text">
        </div>
        <div class="dropdown">
            <button class="dropbtn">
                Genre
                <img src="<?= BASE_URL ?>/images/assets/arrow_down.svg" alt="home" width="12px" height="12px">
            </button>
            <div class="dropdown-content">
                <div class="item">Comedy</div>
                <div class="item">Sports</div>
                <div class="item">Technology</div>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">
                Release Year
                <img src="<?= BASE_URL ?>/images/assets/arrow_down.svg" alt="home" width="12px" height="12px">
            </button>
            <div class="dropdown-content">
                <div class="item">Comedy</div>
                <div class="item">Sports</div>
                <div class="item">Technology</div>
            </div>
        </div>
    </navbar>
    <main>
        <div class="result-container">
            <?php include(dirname(__DIR__) . "/search/result.php")?>
        </div>
    </main>
    <?php include(dirname(__DIR__) . "/common/player.php")?>
</body>
</html>