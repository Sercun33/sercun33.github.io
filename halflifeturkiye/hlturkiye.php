<?php
// index.php - Ana sayfa
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Half-Life Türkiye</title>
  <link rel="stylesheet" href="hlturkiye.css">
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

  <!-- Overlay -->
  <div id="overlay"></div>

  <?php include 'menu.php'; ?>

  <main>
    <!-- Hero Bölümü -->
    <section class="hero">
      <div class="hero-content">
        <h1>Half-Life Türkiye</h1>
        <p>Half-Life evrenine açılan kapı, sırlar ve teoriler burada.</p>
        <a href="lmpozet.php" class="btn">Keşfetmeye Başla</a>
      </div>
    </section>

    <!-- Modern Feature Kartlar -->
    <section class="modern-feature-section">
      <a href="lmpk.php" class="modern-feature-link">
        <div class="modern-feature-card">
          <h2>Karakterler</h2>
          <p>Gordon Freeman, Alyx Vance ve diğer kahramanları keşfet.</p>
        </div>
      </a>

      <a href="haberler.php" class="modern-feature-link">
        <div class="modern-feature-card">
          <h2>Haberler</h2>
          <?php
            // Haberleri JSON'dan çek
            $json_file = 'data/haberler.json';
            if(file_exists($json_file)){
                $haberler = json_decode(file_get_contents($json_file), true);
                if(!empty($haberler)){
                    echo '<ul class="haber-list">';
                    foreach(array_slice($haberler, 0, 3) as $haber){
                        echo '<li><strong>'.htmlspecialchars($haber['baslik']).'</strong><br>';
                        echo '<small>'.htmlspecialchars($haber['tarih']).'</small></li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>Henüz haber yok.</p>';
                }
            } else {
                echo '<p>Henüz haber yok.</p>';
            }
          ?>
        </div>
      </a>

      <a href="lmpo.php" class="modern-feature-link">
        <div class="modern-feature-card">
          <h2>Oyunlar</h2>
          <p>Half-Life serisinin tüm oyunlarını öğren ve tarihçesini incele.</p>
        </div>
      </a>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Half-Life Evreni Valve'a aittir. | Half-Life Türkiye Hayran yapımı bir sitedir.</p>
  </footer>

</body>
</html>
