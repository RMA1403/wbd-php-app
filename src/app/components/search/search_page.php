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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

        <!-- FILTER -->
        <div class="filter">
            <!-- GENRE FILTER -->
            <div class="dropdown genre">
                <button class="dropbtn genre-button">
                    <div class="genre-display">
                        All genre
                    </div>
                    <img src="<?= BASE_URL ?>/images/assets/arrow_down.svg" alt="home" width="12px" height="12px">
                </button>
                <div class="dropdown-content genre-content">
                    <div class="item genre-option" data-value="comedy">Comedy</div>
                    <div class="item genre-option" data-value="sports">Sports</div>
                    <div class="item genre-option" data-value="technology">Technology</div>
                </div>
            </div>
    
            <!-- Number of Episode FILTER -->
            <div class="dropdown eps">
                <button class="dropbtn eps-button">
                    <div class="eps-display">
                        All episodes
                    </div>
                    <img src="<?= BASE_URL ?>/images/assets/arrow_down.svg" alt="home" width="12px" height="12px">
                </button>
                <div class="dropdown-content eps-content">
                    <div class="item eps-option" data-value="eps-cat-1">Less than 20 episodes</div>
                    <div class="item eps-option" data-value="eps-cat-2">20-50 episodes</div>
                    <div class="item eps-option" data-value="eps-cat-3">50-100 episodes</div>
                    <div class="item eps-option" data-value="eps-cat-4">More than 100 episodes</div>
                </div>
            </div>
        </div>
        
        <!-- SORTING -->
        <div class="dropdown date" id="sort">
            <button class="dropbtn sort-button">
                <div class="sort-display">
                    Sort by
                </div>
                <img src="<?= BASE_URL ?>/images/assets/arrow_down.svg" alt="home" width="12px" height="12px">
            </button>
            <div class="dropdown-content sort-content">
                <div class="item sort-option" data-value="alphabet">alphabetical</div>
                <div class="item sort-option" data-value="sort">date joined</div>
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