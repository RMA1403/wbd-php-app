<form id="input-form" action="">
  <div>
    <h3><?= $this->data["FE_FORM_TITLE"] ?? "" ?></h3>

    <?php if ($this->data["FE_SHOW_AUDIO_INPUT"] ?? false) : ?>
      <button id="audio-input-btn">Pilih file MP3, MP4, atau WAV</button>
      <input name="audio-input" type="file" id="audio-input" accept="audio/*" class="hidden" />
    <?php endif; ?>

    <div class="file-name-container hidden">
      <div>
        <p id="file-name" class="b3"></p>
      </div>
      <button id="cancel-file-btn">
        <img src="<?= BASE_URL ?>/images/dashboard/cross.svg" alt="">
      </button>
    </div>

    <input form="input-form" class="b3" id="judul-input" type="text" placeholder="Episode title" required />
    <p><span id="judul-count"></span> / 100 Character</p>

    <textarea class="b3" id="description-input" type="text" placeholder="Episode description"></textarea>
    <p><span id="description-count"></span> / 200 Character</p>

    <p class="sh3"><?= $this->data["FE_FORM_COVER_TEXT"] ?? "" ?></p>
    <div>
      <img id="cover-image" width="200" height="200" src="<?= STORAGE_URL . ($this->data["url_thumbnail"] ?? "/images/placeholder.jpeg") ?> " alt="cover image">
      <button id="change-cover-btn">Change Cover</button>
      <input name="image-input" type="file" id="image-input" accept="image/*" class="hidden">
    </div>
  </div>

  <div class="line"></div>

  <div>
    <button id="save-btn" type="submit" form="input-form">
      <img width="12" height="24" src="<?= BASE_URL ?>/images/dashboard/save_icon.svg" alt="" />

      <p><?= $this->data["FE_FORM_SUBMIT_TEXT"] ?? "" ?></p>
    </button>
  </div>
</form>