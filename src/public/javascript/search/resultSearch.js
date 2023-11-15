import { handlePodcast } from "../podcast/script";

export const handleResultSearch = () => {
    const podcastCardResult = document.querySelectorAll('.podcast-card-result');
    const mainSection = document.querySelector('#main-section');

    podcastCardResult && 
        podcastCardResult.forEach(function(podcastCard) {
            podcastCard.addEventListener('click', () => {
                console.log(podcastCard.dataset.idPodcast)
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `/public/components/podcast?id_podcast=${podcastCard.dataset.idPodcast}`, true);
                
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                    mainSection.innerHTML = xhr.responseText;
                    handlePodcast();
                    }
                };
                
                xhr.send();
                history.pushState({}, '', `http://localhost:8080/public/podcast?id_podcast=${podcastCard.dataset.idPodcast}`);
        });
    });
}