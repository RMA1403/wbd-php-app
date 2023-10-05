<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/player.js" defer></script>
    <title>Audio Player</title>
</head>
<body>
    <div class="player">
        <?php if (isset($this->data["title"])) :?>
            <div class="podcast-details">
                <img class="thumbnail" src="<?= STORAGE_URL . $this->data["url_thumbnail"] ?>" alt="image" width="110" height="110">
                <div class="podcast-info">
                    <div class="b3"><?= $this->data["title"] ?></div>
                    <div class="b4"><?= $this->data["podcast"] ?></div>
                </div>
            </div>
            <div class="audio-player">
                <div class="audio-controller">
                    <div class="prevButton">
                        <img src="<?= BASE_URL ?>/images/assets/prev_icon.svg" alt="prev">
                    </div>
                    <div class="button-player">
                        <div class="play-button">
                            <img src="<?= BASE_URL ?>/images/assets/play_icon.svg" alt="pause">    
                        </div>
                        <div class="pause-button">
                            <img src="<?= BASE_URL ?>/images/assets/pause_icon.svg" alt="pause">    
                        </div>
                    </div>
                    <div class="nextButton">
                        <img src="<?= BASE_URL ?>/images/assets/next_icon.svg" alt="next">
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
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
                bang login bang login bang login
            </div>
        <? endif;?>
    </div>

</body>
</html>