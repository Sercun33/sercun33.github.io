(function() {
  // CSS ekle
  const style = document.createElement('style');
  style.textContent = `
    #music-player-wrapper { position: fixed; bottom: 0; right: 0; z-index: 9999; }
    .player-toggle {
      position: fixed; bottom: 20px; right: 20px;
      z-index: 1006; background: rgba(0,0,0,0.8);
      color: #ff6600; font-size: 24px; padding: 10px 12px;
      border-radius: 50%; cursor: pointer; user-select: none;
      text-align: center;
    }
    .music-player {
      position: fixed; bottom: 80px; right: 20px;
      z-index: 1005; width: 220px; background: rgba(0,0,0,0.85);
      color: #ff6600; font-family: 'Orbitron', sans-serif;
      padding: 15px; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.7);
      text-align: center; display: none;
    }
    .music-player h4 { margin: 0 0 10px; font-size: 14px; }
    .music-player select, .music-player input[type=range], .music-player button {
      width: 100%; margin-bottom: 8px; border-radius: 6px;
    }
    .music-player select { padding: 5px; background: #111; color: #ff6600; border: 1px solid #ff6600; }
    .music-player button { padding: 8px; font-weight: bold; border: none; background: #ff6600; cursor: pointer; }
    .music-player button:hover { background: ##ff6600; }
    #progress-bar { width: 100%; height: 6px; background: #333; border-radius: 3px; cursor: pointer; margin-bottom: 10px; }
    #progress { width: 0%; height: 100%; background: #ff6600; border-radius: 3px; }
  `;
  document.head.appendChild(style);

  // HTML ekle
  const wrapper = document.getElementById("music-player-wrapper");
  wrapper.innerHTML = `
    <div class="player-toggle">🎵</div>
    <div class="music-player">
      <h4>Black Mesa Müzik Sistemi</h4>
      <select id="track-list">
        <option value="music1.mp3">Black Mesa</option>
        <option value="music2.mp3">Ölüm Maçı</option>
        <option value="music3.mp3">Sorgulanabilir Ahlak</option>
        <option value="music4.mp3">Yükseliş</option>
        <option value="music5.mp3">İç Çatışma</option>
      </select>
      <div id="progress-bar"><div id="progress"></div></div>
      <button id="play-pause">▶ Oynat</button>
      <input type="range" id="volume-slider" min="0" max="1" step="0.01">
      <button id="mute-btn">🔊 Ses Açık</button>
      <audio id="bg-music" src="music1.mp3"></audio>
    </div>
  `;

  const audio = document.getElementById("bg-music");
  const playPauseBtn = document.getElementById("play-pause");
  const trackList = document.getElementById("track-list");
  const volumeSlider = document.getElementById("volume-slider");
  const muteBtn = document.getElementById("mute-btn");
  const toggleBtn = document.querySelector(".player-toggle");
  const playerDiv = document.querySelector(".music-player");
  const progressBar = document.getElementById("progress-bar");
  const progress = document.getElementById("progress");

  // Toggle aç/kapa
  toggleBtn.addEventListener("click", () => {
    playerDiv.style.display = (playerDiv.style.display === "block") ? "none" : "block";
  });

  // Play/pause
  playPauseBtn.addEventListener("click", () => {
    if(audio.paused){ audio.play(); playPauseBtn.textContent = "⏸ Durdur"; }
    else{ audio.pause(); playPauseBtn.textContent = "▶ Oynat"; }
  });

  // Track değiştir
  trackList.addEventListener("change", () => {
    audio.src = trackList.value;
    audio.play();
    playPauseBtn.textContent = "⏸ Durdur";
    localStorage.setItem("selectedTrack", trackList.value);
  });

  // Volume
  volumeSlider.addEventListener("input", () => {
    audio.volume = volumeSlider.value;
    localStorage.setItem("volume", volumeSlider.value);
  });

  // Mute
  muteBtn.addEventListener("click", () => {
    audio.muted = !audio.muted;
    muteBtn.textContent = audio.muted ? "🔇 Ses Kapalı" : "🔊 Ses Açık";
    localStorage.setItem("muted", audio.muted);
  });

  // Progress bar güncelle
  audio.addEventListener("timeupdate", () => {
    if(audio.duration){
      const percent = (audio.currentTime / audio.duration) * 100;
      progress.style.width = percent + "%";
    }
  });

  // Progress bar tıklama
  progressBar.addEventListener("click", (e) => {
    const rect = progressBar.getBoundingClientRect();
    audio.currentTime = ((e.clientX - rect.left)/rect.width) * audio.duration;
  });

  // Ayarları yükle
  window.addEventListener("load", () => {
    const savedTrack = localStorage.getItem("selectedTrack");
    const savedVolume = localStorage.getItem("volume");
    const savedMuted = localStorage.getItem("muted");

    if(savedTrack){ trackList.value = savedTrack; audio.src = savedTrack; }
    if(savedVolume){ audio.volume = savedVolume; volumeSlider.value = savedVolume; }
    if(savedMuted){ audio.muted = savedMuted==="true"; muteBtn.textContent = audio.muted?"🔇 Ses Kapalı":"🔊 Ses Açık"; }
  });
	// Şarkıyı loop yap
audio.loop = true;

// Track değiştirirken de loop'u koru
trackList.addEventListener("change", () => {
  audio.src = trackList.value;
  audio.play();
  audio.loop = true; // yeni şarkıyı da loop yap
  playPauseBtn.textContent = "⏸ Durdur";
  localStorage.setItem("selectedTrack", trackList.value);
});

})();
