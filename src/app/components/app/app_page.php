<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">

    <!-- Page CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/home/homeStyle.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/search/search.css">

    <!-- <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/layout.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/pages/main.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/pages/episode.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/components/button.css">
    <!-- JavaScript Library -->
    <script type="module" src="<?= BASE_URL ?>/javascript/toast.mjs" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/util/debounce.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/profile/profile.js" defer></script>
    <script type="module" src="<?= BASE_URL ?>/javascript/dashboard/layout.mjs" defer></script>
    <script type="module" src="<?= BASE_URL ?>/javascript/app/app.js" defer></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Spotify</title>
</head>

<body>
    <?php include(dirname(__DIR__) . "/common/toast.php") ?>

    <?php include(dirname(__DIR__) . "/common/sidebar.php") ?>
    <?php include(dirname(__DIR__) . "/common/profile.php") ?>
    <main id="main-section">
        <!-- Called by app.js -->
    </main>
    <div class="player">
        <div class="sh3 caption">
            play your favorite podcast!
        </div>
    </div>
</body>

</html>