<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- script -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/profile/profile.js" defer></script>
    <title>Profile</title>
</head>
<body>
    <?php if (!isset($this->data["username"])) : ?>
        <div class="profile-section login-button">
            <h5>LOGIN</h5>
        </div>
    <?php else:?>
        <div class="profile-section profile" >
            <img class="profpic" src="<?= STORAGE_URL . $this->data["url_profpic"] ?>" alt="image" width="110" height="110">        
            <div class="sh5"><?= substr($this->data["name"], 0, 10) ?></div>
        </div>
        <div class="profile-menu">
            <div class="item b3" id="menu-profile">Profile</div>
            <div class="item b3" id="logout">Log out</div>
        </div>
        <div class="edit-profile-back">
            <div class="edit-profile-container">
                <div class="profile-detail">
                    <img class="profpic-edit" src="<?= STORAGE_URL . $this->data["url_profpic"] ?>" alt="image">        
                    <div class="edit-info">
                        <div class="sh5">Nama</div>
                        <input type="text">
                        <div class="sh5">Username</div>
                        <input type="text">
                        <div class="sh5">Password</div>
                        <input type="text">
                    </div>
                </div>
                <button class="sh4">Submit</button>
            </div>
        </div>
    <?php endif;?>
</body>
</html>