<aside>
    <div class="sidebar-container">            
        <div class="sidebar-item" onclick="getPage('home')">
            <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/home_icon.svg" alt="home">
            <div class="sh5">Home</div>
        </div>
        <div class="sidebar-item" onclick="getPage('search')">
            <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/search_icon.svg" alt="search">
            <div class="sh5">Search</div>
        </div>
        <div class="sidebar-item" onclick="getPage('library')">
            <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/library_icon.svg" alt="library">
            <div class="sh5">Library</div>
        </div>

        <?php if (isset($_SESSION["role_id"] )) :?>
        <?php if ($_SESSION["role_id"] == 1) :?>
            <div class="sidebar-item" onclick="getPage('dashboard')">
                <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/fire_icon.svg" alt="dashboard">
                <div class="sh5">Dashboard</div>
            </div>
        <?php endif;?>
        <?php endif;?>

    </div>
</aside>