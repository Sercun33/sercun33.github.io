<?php
session_start();
// Yetki kontrolü (Kapı dışarı atma kodu)
if (!isset($_SESSION['yetki']) || $_SESSION['yetki'] !== true) {
    header("Location: giris.php");
    exit;
}

$mesaj = "";

// Form gönderildiğinde haberi kaydet
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['baslik']) && isset($_POST['icerik'])) {
    $dosya = 'haberler.json';
    $mevcut_veriler = file_exists($dosya) ? json_decode(file_get_contents($dosya), true) : [];
    if (!$mevcut_veriler) $mevcut_veriler = [];

    $yeni_haber = [
        "id" => uniqid(),
        "baslik" => $_POST['baslik'],
        "icerik" => $_POST['icerik'],
        "tarih" => date("d.m.Y - H:i") // Otomatik tarih ekler
    ];

    // Yeni haberi en başa ekle
    array_unshift($mevcut_veriler, $yeni_haber);
    file_put_contents($dosya, json_encode($mevcut_veriler, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $mesaj = "Veri başarıyla sisteme yüklendi Sir.";
}

// Çıkış yapma işlemi
if (isset($_GET['cikis'])) {
    session_destroy();
    header("Location: giris.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli</title>
    <link rel="stylesheet" href="taraf.css">
    <style>
        body { background: #050505; color: #fff; font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; }
        .panel-container { max-width: 800px; margin: 0 auto; background: rgba(20,20,20,0.9); padding: 30px; border-radius: 15px; border-top: 4px solid #f58220; }
        input, textarea { width: 100%; padding: 15px; margin: 10px 0; background: #111; border: 1px solid #333; color: #fff; border-radius: 5px; box-sizing: border-box; }
        input:focus, textarea:focus { border-color: #f58220; outline: none; }
        button { background: #f58220; color: #000; padding: 12px 25px; border: none; font-weight: bold; cursor: pointer; border-radius: 5px; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; }
        .logout-btn { background: transparent; color: #ff3333; border: 1px solid #ff3333; }
        .success { color: #4CAF50; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="panel-container">
        <div class="header-flex">
            <h2 style="color: #f58220;">KONTROL PANELİ</h2>
            <a href=""><button class="logout-btn">AĞDAN ÇIK</button></a>
        </div>
        
        <?php if($mesaj != "") echo "<div class='success'>$mesaj</div>"; ?>

        <form method="POST">
            <label style="color: #bbb; font-size: 0.9rem;">Haber Başlığı</label>
            <input type="text" name="baslik" required>
            
            <label style="color: #bbb; font-size: 0.9rem;">Haber İçeriği</label>
            <textarea name="icerik" rows="8" required></textarea>
            
            <button type="submit">VERİTABANINA YAZ</button>
        </form>
    </div>
</body>
</html>