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
        <a href="<?= BASE_URL ?>/dashboard">
            <div class="sidebar-item">
                <img width="32" height="32" src="<?= BASE_URL ?>/images/assets/fire_icon.svg" alt="home">
                <div class="sh5">Dashboard</div>
            </div>
        </a>
        <button id="logout-btn">
            <div class="sidebar-item">
                <img width="26" height="26" src="<?= BASE_URL ?>/images/dashboard/cross.svg" alt="home">
                <div class="sh5">Logout</div>
            </div>
        </button>
        <script>
            const logoutBtn = document.getElementById("logout-btn");
            logoutBtn.addEventListener("click", (e) => {
                e.preventDefault();
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "/public/logout");
                xhr.send()
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        window.location.replace("/public/login")
                    }
                }
            })
        </script>
    </div>
</div>