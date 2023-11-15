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
                <div class="item genre-option" data-value="">All genre</div>
                <div class="item genre-option" data-value="comedy">Comedy</div>
                <div class="item genre-option" data-value="horror">Horror</div>
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
                <div class="item eps-option">All episodes</div>
                <div class="item eps-option">Less than 20 episodes</div>
                <div class="item eps-option">20-50 episodes</div>
                <div class="item eps-option">50-100 episodes</div>
                <div class="item eps-option">More than 100 episodes</div>
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
<div class="result-container">
    <?php include(dirname(__DIR__) . "/search/result.php") ?>
</div>
<script type="text/javascript" src="<?= BASE_URL ?>/javascript/search/search.js" defer></script>