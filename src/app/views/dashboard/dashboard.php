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
          <img class="podcast-thumbnail-img" src="<?= BASE_URL ?>/images/dashboard/sample-podcast.jpeg" alt="">

          <div class="podcast-description">
            <div class="podcast-category">
              <p>Kategori Podcast</p>
            </div>

            <h3>Nama Podcast</h3>
            <p class="b5">Ini adalah contoh teks deskripsi dummy yang dibuat oleh ChatGPT. Teks ini mengilustrasikan kemampuan model dalam menghasilkan teks deskripsi dengan panjang yang lebih besar. ChatGPT adalah AI canggih yang dirancang untuk memberikan informasi, menyelesaikan masalah, dan memberikan panduan dalam berbagai topik. </p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>