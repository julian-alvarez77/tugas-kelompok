<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "tugas_kelompok";
$charset = 'utf8mb4';

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$handler = new PDO($dsn, $username, $password, $options);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 5. Field tidak ada yang terisi
    if (empty($email) && empty($password)) {
        $MESSAGE = "Email dan password harus diisi.";
        $_SESSION['MESSAGE'] = $MESSAGE;
        header("Location: index.php");
        exit;
    }
    // 4. Password diisi tapi email kosong
    else if (empty($email)) {
        $MESSAGE = "Email harus diisi.";
        $_SESSION['MESSAGE'] = $MESSAGE;
        header("Location: index.php");
        exit;
    }
    // 3. Email diisi tapi password kosong
    else if (empty($password)) {
        $MESSAGE = "Password harus diisi.";
        $_SESSION['MESSAGE'] = $MESSAGE;
        header("Location: index.php");
        exit;
    }
    // 2. Format email tidak valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $MESSAGE = "Format email tidak valid.";
        $_SESSION['MESSAGE'] = $MESSAGE;
        header("Location: index.php");
        exit;
    }
    else {
        $q = $handler->prepare('SELECT * FROM users WHERE email = ?');
        $q->execute(array($email));
    
        if ($q->rowCount() > 0){
            $result = $q -> fetch(PDO::FETCH_ASSOC);
            $hash_pwd = $result['password'];
            $hash = password_verify($password, $hash_pwd);
    
            if ($hash == 0) {
                $MESSAGE = "Password salah.";
                $_SESSION['MESSAGE'] = $MESSAGE;
                header("Location: index.php");
                exit;
            }  
            else {
                $_SESSION['email'] = $email;
                header("location: home.php");
                exit;
            } 
        }
        else {
            $MESSAGE = "User tidak ditemukan.";
            $_SESSION['MESSAGE'] = $MESSAGE;
            header("Location: index.php");
            exit;
        }
    }
}