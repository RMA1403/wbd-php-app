<section>
    <?php if (!isset($this->data["username"])) : ?>
        <div class="profile-section login-button">
            <h5><a href="<?= BASE_URL ?>/login">LOGIN</a></h5>
        </div>
    <?php else : ?>
        <div class="profile-section profile">
            <img class="profpic" src="<?= STORAGE_URL . $this->data["url_profpic"] ?>" alt="image" width="110" height="110">
            <div class="sh5"><?= substr($this->data["name"], 0, 10) ?></div>
        </div>
        <div class="profile-menu">
            <div class="item b3" id="menu-profile">Profile</div>
            <button class="item b3" id="logout">Log out</button>
        </div>
        <div class="edit-profile-back">
            <div class="edit-profile-container">
                <div class="profile-detail">
                    <img class="profpic-edit" src="<?= STORAGE_URL . $this->data["url_profpic"] ?>" alt="image">
                    <div class="edit-info">
                        <div class="sh5">Nama</div>
                        <input type="text" value="<?=$this->data["name"] ?>" id="name-form">
                        <div class="sh5">Username</div>
                        <input type="text"value="<?=$this->data["username"]?>" id="username-form">
                    </div>
                </div>
                <button class="sh3" id="submit-profile">Save</button>
                <p id="save-profile-alert"></p>
            </div>
        </div>
    <?php endif; ?>
</section>
<script>
    const logoutBtn = document.getElementById("logout");
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