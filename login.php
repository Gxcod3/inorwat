<?php
session_start();
include 'db_connect.php'; // koneksi ke database

// Proses login jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['email']     = $user['email'];

            header("Location: monitoring.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Password salah!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Email tidak ditemukan!";
        header("Location: login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Intelligent Organic Waste Transformation</title>
  <link rel="stylesheet" href="login-style.css">
</head>
<body>
  <div class="top-bar">
    <div class="logo-group">
      <img src="images/inorwat-logo.png" alt="Logo Inorwat">
      <span class="logo-text">Intelligent Organic Waste Transformation</span>
    </div>
  </div>

  <div class="login-container">
    <h2 class="login-title">Login</h2>

    <form class="login-form" action="login.php" method="POST" autocomplete="off">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Masukkan email" required>

      <label for="password">Password</label>
      <div class="password-wrapper">
        <input type="password" id="password" name="password" placeholder="Masukkan password" required minlength="6">
        <span class="toggle-password" onclick="togglePassword()">👁️</span>
      </div>

      <!-- Pesan sukses -->
      <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
        <p class="success-message">Akun Berhasil Di Daftar</p>
      <?php endif; ?>

      <!-- Pesan akun sudah terdaftar -->
      <?php if (isset($_GET['status']) && $_GET['status'] === 'exists'): ?>
        <p class="exists-message">Akun Sudah Terdaftar</p>
      <?php endif; ?>

      <!-- Pesan error login -->
      <?php if (!empty($_SESSION['login_error'])): ?>
        <p class="error-message"><?= $_SESSION['login_error'] ?></p>
        <?php unset($_SESSION['login_error']); ?>
      <?php endif; ?>

      <button type="submit" class="login-button">LOGIN</button>
    </form>

    <div class="register-link">
      <p>Belum punya akun? <a href="register.php">Register</a></p>
    </div>
    <div class="back-link">
      <p><a href="index.php">← Kembali ke Beranda</a></p>
    </div>
  </div>

  <footer>
    <p>© 2026 Intelligent Organic Waste Transformation - Telkom University Surabaya</p>
  </footer>

  <!-- Script untuk toggle password -->
  <script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      const toggleIcon = document.querySelector(".toggle-password");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.textContent = "🙈"; // ikon berubah saat terlihat
      } else {
        passwordField.type = "password";
        toggleIcon.textContent = "👁️"; // kembali ke ikon mata
      }
    }
  </script>
</body>
</html>
