
<form data-form-type="<?= $this->data["INPUT_FORM_TYPE"] ?? "" ?>" id="input-form" action="">
  <div>
    <h3><?= $this->data["INPUT_FORM_TITLE"] ?? "" ?></h3>

    <?php if ($this->data["INPUT_FORM_SHOW_AUDIO_INPUT"] ?? false) : ?>
      <button id="audio-input-btn">Pilih file MP3, MP4, atau WAV</button>
      <input name="audio-input" type="file" id="audio-input" accept="audio/*" class="hidden" />
    <?php endif; ?>

    <div class="file-name-container hidden">
      <div>
        <p id="file-name" class="b3"></p>
      </div>
      <button id="cancel-file-btn">
        <img width="25" height="25" src="<?= BASE_URL ?>/images/dashboard/cross.svg" alt="">
      </button>
    </div>

    <input form="input-form" class="b3" id="judul-input" type="text" placeholder="<?= $this->data["INPUT_FORM_TITLE_TEXT"] ?? "" ?>" required />
    <p><span id="judul-count"></span> / 50 Character</p>

    <textarea class="b3" id="description-input" type="text" placeholder="<?= $this->data["INPUT_FORM_DESCRIPTION_TEXT"] ?? "" ?>"></textarea>
    <p><span id="description-count"></span> / 1000 Character</p>

    <?php if ($this->data["INPUT_FORM_SHOW_CATEGORY_INPUT"] ?? false) : ?>
      <div class="category-container">
        <button id="category-input-btn" class="">
          <p class="b3">Choose category</p>
        </button>

        <ul id="category-choices" class="hidden">
          <?php foreach ($this->data["categories"] as $category) : ?>
            <li>
              <p class="b3"><?= $category ?></p>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <select class="hidden" id="category-input">
      <option value=""></option>
        <?php foreach ($this->data["categories"] as $category) : ?>
          <option value="<?= $category ?>"></option>
        <?php endforeach; ?>
      </select>
    <?php endif; ?>

    <p class="sh3"><?= $this->data["INPUT_FORM_COVER_TEXT"] ?? "" ?></p>
    <div>
      <img id="cover-image" width="200" height="200" src="<?= STORAGE_URL . ($this->data["url_thumbnail"] ?? "/images/placeholder.jpeg") ?> " alt="cover image">
      <button id="change-cover-btn">Change Cover</button>
      <input name="image-input" type="file" id="image-input" accept="image/*" class="hidden">
    </div>
  </div>
  
  <div class="line"></div>

  <div>
    <?php if ($this->data["INPUT_FORM_DELETE_TEXT"] ?? false) : ?>
      <button id="delete-btn" form="input-form">
        <img width="19" height="23" src="<?= BASE_URL ?>/images/dashboard/white_trash.svg" alt="" />

        <p><?= $this->data["INPUT_FORM_DELETE_TEXT"] ?? "" ?></p>
      </button>
    <?php endif; ?>


    <button id="save-btn" type="submit" form="input-form">
      <img width="12" height="24" src="<?= BASE_URL ?>/images/dashboard/save_icon.svg" alt="" />

      <p><?= $this->data["INPUT_FORM_SUBMIT_TEXT"] ?? "" ?></p>
    </button>
  </div>
</form>