<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/dashboard_main.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/button.css">

  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/dashboard/layout.js" defer></script>
  <title>Main Dashboard</title>
</head>

<body>
  <?php include(dirname(__DIR__) . "/common/sidebar.php") ?>

  <main>
    <div class="dashboard-nav">
      <div>
        <p id="dashboard-link" class="sh4">Dashboard</p>
        <p id="episode-link" class="sh4">Episode</p>
      </div>
    </div>

    <div class="dashboard-nav-line"></div>

    <section id="dashboard-section"></section>
  </main>

  <?php include(dirname(__DIR__) . "/common/player.php") ?>
</body>

</html>