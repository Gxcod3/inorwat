<?php
include 'db_connect.php'; // koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Validasi konfirmasi password
    if ($password !== $confirm) {
        echo "Password dan konfirmasi tidak sama. <a href='register.php'>Coba lagi</a>";
        exit();
    }

    // Cek apakah email sudah terdaftar
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        // Redirect ke login.php dengan status 'exists'
        header("Location: login.php?status=exists");
        exit();
    }
    $check->close();

    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data dengan prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, fullname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $fullname, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Redirect ke login.php dengan status sukses
        header("Location: login.php?status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
