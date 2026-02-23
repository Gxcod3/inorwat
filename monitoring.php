<?php
session_start();

$token = "H5hayR1JvV0EhWsoSiq2vsZ6SW8-hh3N";

function getData($token, $id) {
    $url = "https://blynk.cloud/external/api/get?token=$token&dataStreamId=$id";
    $response = @file_get_contents($url);
    return $response !== false ? $response : "-";
}

function updateData($token, $id, $value) {
    $url = "https://blynk.cloud/external/api/update?token=$token&dataStreamId=$id&value=$value";
    $response = @file_get_contents($url);
    return $response !== false ? $response : "Error";
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $value = intval($_GET['action']);
    updateData($token, $id, $value);
    header("Location: monitoring.php");
    exit;
}

$humidity = getData($token, 1);
$temperature = getData($token, 2);
$waterPumpStatus = getData($token, 5);
$fanComposterStatus = getData($token, 4);
$pengadukStatus = getData($token, 7);
$heaterStatus = getData($token, 6);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Monitoring IoT - Inorwat</title>
  <link rel="stylesheet" href="monitoring-style.css">
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 34px;
    }
    .slider:before {
      position: absolute;
      content: "";
      height: 26px; width: 26px;
      left: 4px; bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }
    input:checked + .slider {
      background-color: #2e7d32;
    }
    input:checked + .slider:before {
      transform: translateX(26px);
    }
  </style>
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

    <section class="sensor-data">
      <div class="card humidity-card">
        <h3>Humidity</h3>
        <div class="humidity-display">
          <img src="images/speedmeter-humidity.png" alt="Humidity Gauge" class="humidity-gauge">
          <span class="humidity-value"><?= $humidity ?>%</span>
        </div>
      </div>

      <div class="card temperature-card">
        <h3>Temperature</h3>
        <div class="temperature-display">
          <img src="images/icons8-thermometer-48.png" alt="Temperature Icon" class="temperature-icon">
          <span class="temperature-value"><?= $temperature ?>°C</span>
        </div>
      </div>

      <div class="card control-card">
        <h3>Water Pump</h3>
        <label class="switch">
          <input type="checkbox" <?= ($waterPumpStatus == 1 ? 'checked' : '') ?>
                 onchange="location.href='monitoring.php?action='+(this.checked?1:0)+'&id=5'">
          <span class="slider"></span>
        </label>
      </div>

      <div class="card control-card">
        <h3>Fan Composter</h3>
        <label class="switch">
          <input type="checkbox" <?= ($fanComposterStatus == 1 ? 'checked' : '') ?>
                 onchange="location.href='monitoring.php?action='+(this.checked?1:0)+'&id=4'">
          <span class="slider"></span>
        </label>
      </div>

      <div class="card control-card">
        <h3>Pengaduk</h3>
        <label class="switch">
          <input type="checkbox" <?= ($pengadukStatus == 1 ? 'checked' : '') ?>
                 onchange="location.href='monitoring.php?action='+(this.checked?1:0)+'&id=7'">
          <span class="slider"></span>
        </label>
      </div>

      <div class="card control-card">
        <h3>Pemanas (Heater)</h3>
        <label class="switch">
          <input type="checkbox" <?= ($heaterStatus == 1 ? 'checked' : '') ?>
                 onchange="location.href='monitoring.php?action='+(this.checked?1:0)+'&id=6'">
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
