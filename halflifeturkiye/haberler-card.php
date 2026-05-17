<?php
$haberler = json_decode(file_get_contents('haberler.json'), true);
if (!$haberler) $haberler = [];

foreach ($haberler as $haber) {
    echo '<div class="news-card">';
    echo '<h3>'.htmlspecialchars($haber['baslik']).'</h3>';
    echo '<p>'.htmlspecialchars($haber['icerik']).'</p>';
    echo '</div>';
}
?>
