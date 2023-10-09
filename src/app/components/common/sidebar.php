<div class="sidebar">
    <div class="sidebar-container">
        <a href="<?= BASE_URL ?>/home">
            <div class="sidebar-item">
                <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/home_icon.svg" alt="home">
                <div class="sh5">Home</div>
            </div>
        </a>
        <a href="<?= BASE_URL ?>/search">
            <div class="sidebar-item">
                <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/search_icon.svg" alt="home">
                <div class="sh5">Search</div>
            </div>
        </a>
        <a href="<?= BASE_URL ?>/library">
            <div class="sidebar-item">
                <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/library_icon.svg" alt="home">
                <div class="sh5">Library</div>
            </div>
        </a>
        <?php if (isset($_SESSION["role_id"] )) :?>
        <?php if ($_SESSION["role_id"] == 1) :?>
        <a href="<?= BASE_URL ?>/dashboard">
            <div class="sidebar-item">
                <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/fire_icon.svg" alt="home">
                <div class="sh5">Dashboard</div>
            </div>
        </a>
        <?php endif;?>
        <?php endif;?>

    </div>
</div>