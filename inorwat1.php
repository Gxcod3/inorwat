<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Inorwat I</title>
  <link rel="stylesheet" href="monitoring-style.css">
</head>
<body>
  <?php include 'sidebar.php'; ?>
  <main class="main-content">
    <header class="top-header">
      <div class="greeting">Halo <?= $_SESSION['username'] ?? 'Salman' ?></div>
    </header>
    <section class="sensor-data">
      <!-- Kosong -->
    </section>
  </main>
</body>
</html>
