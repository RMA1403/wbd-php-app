<?php if (isset($this->data["title"])) : ?>
    <div class="podcast-details">
        <img class="thumbnail" src="<?= STORAGE_URL . $this->data["url_thumbnail"] ?>" alt="image" width="110" height="110">
        <div class="podcast-info">
            <div class="b3"><?= $this->data["title"] ?></div>
            <div class="b4"><?= $this->data["podcast"] ?></div>
        </div>
    </div>
    <div class="audio-player">
        <div class="audio-controller">
            <div class="button-player">
                <div class="play-button-player">
                    <img src="<?= BASE_URL ?>/images/assets/play_icon.svg" alt="pause">
                </div>
                <div class="pause-button-player">
                    <img src="<?= BASE_URL ?>/images/assets/pause_icon.svg" alt="pause">
                </div>
            </div>
        </div>
        <div class="progress-control">
            <div class="current-time">00.00</div>
            <input type="range" name="progress-bar" class="progress-bar" step="0.01" value="0">
            <div class="duration">00:00</div>
        </div>
    </div>
    <div class="volume-control">
        <div></div>
    </div>
    <div class="hide-player">
        <audio controls class="audio-player">
            <source src="<?= STORAGE_URL . $this->data["url_audio"] ?>" type="audio/mpeg">
        </audio>
    </div>
<? else : ?>
    <div class="sh3 caption">
        play your favorite podcast!
    </div>
<? endif; ?>