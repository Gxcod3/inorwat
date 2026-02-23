<?php
session_start();
include 'db_connect.php';

$sql = "SELECT * FROM sensor_data ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Monitoring IoT - Inorwat</title>
  <link rel="stylesheet" href="monitoring-style.css">
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <main class="main-content">
    <header class="top-header">
      <div class="datetime">
        <span id="clock"></span>
        <span id="date"></span>
      </div>
      <div class="greeting">Hello <?= $_SESSION['username'] ?? 'Salman' ?></div>
    </header>

    <!-- Sensor Data Grid -->
    <section class="sensor-data">
      <!-- Baris 1 -->
      <div class="card humidity-card">
        <h3>Humidity</h3>
        <div class="humidity-display">
          <img src="images/speedmeter-humidity.png" alt="Humidity Gauge" class="humidity-gauge">
          <span class="humidity-value"><?= $data['humidity'] ?? '-' ?>%</span>
        </div>
      </div>

      <div class="card temperature-card">
        <h3>Temperature</h3>
        <div class="temperature-display">
          <img src="images/icons8-thermometer-48.png" alt="Temperature Icon" class="temperature-icon">
          <span class="temperature-value"><?= $data['temperature'] ?? '-' ?>°C</span>
        </div>
      </div>

      <!-- Baris 2 -->
      <div class="card ph-card">
        <h3>pH</h3>
        <div class="ph-display">
          <img src="images/ph.png" alt="pH Icon" class="ph-icon">
          <span class="ph-value"><?= $data['ph'] ?? '-' ?></span>
        </div>
      </div>

      <div class="card ammonia-card">
        <h3>Ammonia</h3>
        <div class="ammonia-display">
          <img src="images/speedmeter-amonia.png" alt="Ammonia Gauge" class="ammonia-gauge">
          <span class="ammonia-value"><?= $data['ammonia'] ?? '-' ?> ppm</span>
        </div>
      </div>

      <!-- Baris 3: Kontrol -->
      <div class="card control-card">
        <h3>Pemanas (Heater)</h3>
        <label class="switch">
          <input type="checkbox" id="heater">
          <span class="slider"></span>
        </label>
      </div>

      <div class="card control-card">
        <h3>Penyemprot (Sprayer)</h3>
        <label class="switch">
          <input type="checkbox" id="sprayer" checked>
          <span class="slider"></span>
        </label>
      </div>
    </section>
  </main>

  <script>
    function updateDateTime() {
      const now = new Date();
      document.getElementById("clock").textContent = now.toLocaleTimeString();
      document.getElementById("date").textContent = now.toLocaleDateString("id-ID", {
        weekday: "long", year: "numeric", month: "long", day: "numeric"
      });
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();
  </script>
</body>
</html>
