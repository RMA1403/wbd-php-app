<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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