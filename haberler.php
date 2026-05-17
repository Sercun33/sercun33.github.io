<?php
// JSON'dan verileri çek (Hata vermemesi için boş dizi ataması yapıldı)
$dosya = 'haberler.json';
$haberler = file_exists($dosya) ? json_decode(file_get_contents($dosya), true) : [];
if (!$haberler) $haberler = [];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/tr/favicon.png">
    <title>Haberler - Half-Life Türkiye</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="taraf.css">
    <style>
        /* SCROLLBAR & BACKGROUND */
        html { scrollbar-width: thin; scrollbar-color: #f58220 #050505; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #050505; border-left: 1px solid rgba(245, 130, 32, 0.15); }
        ::-webkit-scrollbar-thumb { background: #f58220; border-radius: 4px; transition: 0.3s; }
        ::-webkit-scrollbar-thumb:hover { background: #ff9940; }

        .wiki-wrapper { padding: 40px 8%; display: grid; grid-template-columns: 320px 1fr; gap: 50px; text-align: left; }
        .sidebar-assets { display: flex; flex-direction: column; gap: 25px; }
        
        .profile-container { background: rgba(20,20,20,0.8); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 20px; text-align: center; border-bottom: 3px solid #f58220; }
        
        .main-article { display: flex; flex-direction: column; gap: 30px; }
        .news-ribbon { background: rgba(20,20,20,0.8); border-left: 5px solid #f58220; padding: 25px; border-radius: 0 20px 20px 0; transition: 0.3s; }
        .news-ribbon:hover { transform: translateX(5px); background: rgba(30,30,30,0.9); }
        
        .news-title { color: #fff; font-size: 1.4rem; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .news-date { color: #f58220; font-size: 0.8rem; font-weight: bold; margin-bottom: 15px; display: block; letter-spacing: 1px; }
        .news-content { color: #bbb; line-height: 1.7; }
        
        .no-news { text-align: center; color: #888; padding: 50px; border: 1px dashed rgba(255,255,255,0.1); border-radius: 10px; }

        @media (max-width: 992px) {
            .wiki-wrapper { grid-template-columns: 1fr; padding: 20px 5%; }
            .sidebar-assets { order: 2; }
            .main-article { order: 1; }
        }
    </style>
</head>
<body oncontextmenu="return false">

    <div id="preloader"><img src="img/tr/hltrwikiweb.png" class="loader-logo"></div>

    <div id="main-wrapper" style="opacity: 0; transition: 1s;">
        <nav class="navbar">
            <a href="index.html" class="logo">
                <img src="img/tr/hltrwikiweb.png" alt="Logo">
                <span>HALF-LIFE <span class="orange-text">TÜRKİYE</span></span>
            </a>
            <div class="menu-btn" id="menuBtn"><div class="menu-btn__burger"></div></div>
            <ul class="nav-links" id="navLinks">
                <li><a href="index.html">Anasayfa</a></li>
                <li><a href="karakterler.html">Karakterler</a></li>
                <li><a href="dusmanlar.html">DÜŞMANLAR</a></li>
                <li><a href="silahlar.html">SİLAHLAR</a></li>
                <li><a href="video.html">Videolar</a></li>
                <li><a href="minioyun.html">Mini Oyun</a></li>
                <li><a href="haberler.php" class="active">Haberler</a></li>
                <li><a href="modlar.html">Modlar</a></li>
                <li><a href="kronoloji.html">TImelıne</a></li>
                <li><a href="mekan.html">Mekanlar</a></li>
                <li><a href="halflifeturkiye.html">Hakkımızda</a></li>
            </ul>
        </nav>

        <main class="wiki-wrapper">
            <aside class="sidebar-assets">
                <div class="profile-container">
                    <img src="img/tr/hltrwikiweb.png" alt="HLTR İletişim" style="width: 80px; margin-bottom: 15px;">
                    <div class="char-name" style="font-size: 1.2rem; font-weight: 800; margin-top: 10px;">HABER AĞI</div>
                    <div class="char-role" style="color: #f58220; font-size: 0.8rem; font-weight: 700; text-transform: uppercase;">Evrenden Son Gelişmeler</div>
                </div>
            </aside>

            <section class="main-article">
                <?php if (empty($haberler)): ?>
                    <div class="no-news">Şu an için ağda yeni bir veri bulunmuyor.</div>
                <?php else: ?>
                    <?php foreach ($haberler as $haber): ?>
                        <div class="news-ribbon">
                            <h2 class="news-title"><?= htmlspecialchars($haber['baslik']) ?></h2>
                            <span class="news-date"><i class="fa-regular fa-clock"></i> <?= htmlspecialchars($haber['tarih']) ?></span>
                            <div class="news-content">
                                <?= nl2br(htmlspecialchars($haber['icerik'])) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('preloader').style.display = 'none';
                document.getElementById('main-wrapper').style.opacity = '1';
            }, 300);
        });

        const menuBtn = document.getElementById('menuBtn');
        const navLinks = document.getElementById('navLinks');
        if(menuBtn && navLinks) {
            menuBtn.addEventListener('click', () => {
                menuBtn.classList.toggle('open');
                navLinks.classList.toggle('open');
            });
        }
    </script>
</body>
</html>