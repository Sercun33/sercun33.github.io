<?php
session_start();

$admin_user = "sercan";
$admin_pass = "123456";
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['kullanici'] === $admin_user && $_POST['sifre'] === $admin_pass) {
        $_SESSION['yetki'] = true;
        header("Location: panel.php");
        exit;
    } else {
        $mesaj = "SİSTEM UYARISI: Yetkisiz Erişim Denemesi!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Girişi - Yönetim</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap">
    <link rel="stylesheet" href="taraf.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background: #050505 url('img/black-mesa-bg.jpg') no-repeat center center fixed; background-size: cover; font-family: 'Plus Jakarta Sans', sans-serif;}
        body::before { content: ""; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.9); z-index: -1; }
        .login-box { background: rgba(20, 20, 20, 0.9); border: 1px solid rgba(245, 130, 32, 0.3); border-radius: 15px; padding: 40px; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 0 20px rgba(245, 130, 32, 0.1); }
        .login-box h2 { color: #f58220; letter-spacing: 2px; margin-bottom: 20px; }
        .login-box input { width: 100%; padding: 12px; margin: 10px 0; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px; outline: none; transition: 0.3s; }
        .login-box input:focus { border-color: #f58220; }
        .login-box button { width: 100%; padding: 12px; margin-top: 15px; background: #f58220; color: #000; font-weight: 800; border: none; border-radius: 5px; cursor: pointer; transition: 0.3s; letter-spacing: 1px; }
        .login-box button:hover { background: #ff9940; transform: scale(1.02); }
        .error { color: #ff3333; font-size: 0.85rem; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="img/tr/hltrwikiweb.png" alt="Logo" style="width: 60px; margin-bottom: 15px;">
        <h2>GÜVENLİK AĞI</h2>
        <?php if($mesaj != "") echo "<div class='error'>$mesaj</div>"; ?>
        <form method="POST">
            <input type="text" name="kullanici" placeholder="Operatör Kimliği" required>
            <input type="password" name="sifre" placeholder="Erişim Şifresi" required>
            <button type="submit">AĞA BAĞLAN</button>
        </form>
    </div>
</body>
</html>