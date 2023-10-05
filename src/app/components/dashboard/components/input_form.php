<form id="input-form">
  <div>
    <h3>Masukan Detail Episode</h3>

    <button id="file-input-btn">Pilih file MP3, MP4, atau WAV</button>
    <input type="file" id="file-input" accept="audio/*" class="hidden">

    <div class="file-name-container hidden">
      <div>
        <p id="file-name" class="b3"></p>
      </div>
      <button id="cancel-file-btn">
        <img src="<?= BASE_URL ?>/images/dashboard/cross.svg" alt="">
      </button>
    </div>

    <input class="b3" id="judul-input" type="text" placeholder="Episode title">
    <p><span id="judul-count"></span> / 100 Character</p>

    <textarea class="b3" id="description-input" type="text" placeholder="Episode description"></textarea>
    <p><span id="description-count"></span> / 100 Character</p>
  </div>
</form>