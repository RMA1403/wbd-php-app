export const handleHome = () => {
    const podcastCardHome = document.querySelectorAll('.home-podcast-card');
    const mainSection = document.querySelector('#main-section');

    podcastCardHome && 
        podcastCardHome.forEach(function(podcastCard) {
            podcastCard.addEventListener('click', () => {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `/public/components/podcast?id_podcast=${podcastCard.dataset.idPodcast}`, true);
                
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                    mainSection.innerHTML = xhr.responseText;
                    }
                };
                
                xhr.send();
                history.pushState({}, '', `http://localhost:8080/public/podcast?id_podcast=${podcastCard.dataset.idPodcast}`);
        });
    });
}