<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the inputs
    if (empty($email) || empty($password)) {
        $_SESSION['MESSAGE'] = "Email dan password harus diisi.";
        header("Location: register.php");
        exit;
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['MESSAGE'] = "Format email tidak valid.";
        header("Location: register.php");
        exit;
    }
    else if (strlen($password) < 8) {
        $_SESSION['MESSAGE'] = "Password harus memiliki setidaknya 8 karakter.";
        header("Location: register.php");
        exit;
    }
    else {
        // Check if the email is already registered
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Email is already registered
            $_SESSION['MESSAGE'] = "Email sudah terdaftar.";
            header("Location: register.php");
            exit;
        }
        else {
            // Email is not registered, insert the new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Registration successful
                $_SESSION['MESSAGE'] = "Registrasi berhasil. Silahkan login.";
                header("Location: index.php");
                exit;
            }
            else {
                // Registration failed
                $_SESSION['MESSAGE'] = "Registrasi gagal. Silahkan coba lagi.";
                header("Location: register.php");
                exit;
            }
        }
    }
}