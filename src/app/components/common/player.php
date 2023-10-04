<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/player.js" defer></script>
    <title>Document</title>
</head>
<body>
<div class="player">
        <div class="podcast-details">
            <img src="<?= STORAGE_URL . $this->data["url_thumbnail"] ?>" alt="image" width="110" height="110">
            <div class="podcast-info">
                <div class="sh4"><?= $this->data["title"] ?></div>
                <div class="sh5"><?= $this->data["podcaster"] ?></div>
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
        <div class="sound-control">
            <div></div>
        </div>
        <div class="hide-player">
            <audio controls class="audio-player">
                <source src="<?= STORAGE_URL ?>/episodes/audio_tester.mp3" type="audio/mpeg">
            </audio>
        </div>
    </div>
</body>
</html>