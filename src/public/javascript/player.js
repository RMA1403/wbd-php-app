const audioPlayer = document.querySelector('audio');
const playButton = document.querySelector('.play-button');
const pauseButton = document.querySelector('.pause-button');
const duration = document .querySelector('.duration');
const currentTime = document.querySelector('.current-time');
const progressBar = document.querySelector('.progress-bar');

function formatTime(duration) {
    const minutes = Math.floor(duration / 60);
    const seconds = Math.floor(duration % 60);
    const formattedMinutes = String(minutes).padStart(2, '0');
    const formattedSeconds = String(seconds).padStart(2, '0');
    return `${formattedMinutes}:${formattedSeconds}`;
}

if (audioPlayer) {
    // Play button
    playButton.addEventListener("click", () => {
        playButton.style.display = "none";
        pauseButton.style.display = "block";
        audioPlayer.play()
        .then(() => {
            console.log("Audio is playing.");
        })
        .catch(error => {
            console.error("Error playing audio:", error);
        });
    });

    // Pause button
    pauseButton.addEventListener("click", () => {
        pauseButton.style.display = "none";
        playButton.style.display = "block";
        audioPlayer.pause();
    });

    document.addEventListener("DOMContentLoaded", () => {
        duration.textContent = formatTime(audioPlayer.duration);
    });
    
    audioPlayer.addEventListener('timeupdate', () => {
        // update current time
        currentTime.textContent = formatTime(audioPlayer.currentTime);

        // update progress bar
        const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        progressBar.value = progress;
    });

    progressBar.addEventListener("input", (e) => {
        const seconds = (e.target.value / 100) * audioPlayer.duration;
        audioPlayer.currentTime = seconds;
        currentTime.textContent = formatTime(audioPlayer.currentTime);
    });
}

