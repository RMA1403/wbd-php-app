<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
  <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/dashboard/main_dashboard.css">
  <title>Main Dashboard</title>
</head>

<body>
  <nav class="navbar"></nav>

  <main>
    <div class="dashboard-content">
      <div class="podcast-card">
        <div class="card-header-container">
          <img class="podcast-thumbnail-img" src="<?= STORAGE_URL . $this->data["url_thumbnail"] ?>" alt="">

          <div class="podcast-description">
            <div class="podcast-category">
              <p><?= $this->data["category"] ?></p>
            </div>

            <h3><?= $this->data["title"] ?></h3>
            <p class="b5"><?= $this->data["description"] ?></p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>