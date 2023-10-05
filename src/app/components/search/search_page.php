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
        <!-- SEARCH BAR -->
        <div class="search-bar">
            <img src="<?= BASE_URL ?>/images/assets/search_icon.svg" alt="home" width="24px" height="24px">
            <input id="search-input" type="text">
        </div>

        <!-- GENRE FILTER -->
        <div class="dropdown genre">
            <button class="dropbtn">
                <div class="genre-display">
                    Genre
                </div>
                <img src="<?= BASE_URL ?>/images/assets/arrow_down.svg" alt="home" width="12px" height="12px">
            </button>
            <div class="dropdown-content">
                <div class="item genre-option" data-value="comedy">comedy</div>
                <div class="item genre-option" data-value="sports">sports</div>
                <div class="item genre-option" data-value="technology">technology</div>
            </div>
        </div>

        <!-- RELEASE YEAR FILTER -->
        <div class="dropdown">
            <button class="dropbtn">
                Release Year
                <img src="<?= BASE_URL ?>/images/assets/arrow_down.svg" alt="home" width="12px" height="12px">
            </button>
            <div class="dropdown-content">
                <div class="item">2023</div>
                <div class="item">2022</div>
                <div class="item">2021</div>
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