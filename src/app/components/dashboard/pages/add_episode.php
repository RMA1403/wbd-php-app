<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/components/input-form.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/pages/add-episode.css">

  <script type="module" src="<?= BASE_URL ?>/javascript/dashboard/inputForm.js" defer></script>
  <script type="module" src="<?= BASE_URL ?>/javascript/toast.mjs" defer></script>
  <title>Main Dashboard</title>
</head>

<body>
  <?php include(dirname(__DIR__) . "/../common/sidebar.php") ?>
  <?php include(dirname(__DIR__) . "/../common/toast.php") ?>

  <main>
    <section class="form-section">
      <?php include(dirname(__DIR__) . "/components/input_form.php") ?>
    </section>
  </main>

  <!-- <?php include(dirname(__DIR__) . "/../common/player.php") ?> -->
</body>

</html>