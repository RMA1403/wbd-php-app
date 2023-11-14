import { showErrorToast, showSuccessToast } from "../toast.mjs";

export function handlePlaylist(){

    const trashEl = document.querySelectorAll('.bx-trash');
    const playlistContainer = document.querySelector('.playlist-container')

    if(trashEl.length !== 0){
        trashEl.forEach(function(trash){
        trash.addEventListener("click", (e) => {
            e.preventDefault();

            const podcastId = trash.dataset.id;
            const playlistId = playlistContainer.dataset.id;
        
            xhr.open("DELETE", `/public/playlist?podcast_id=${podcastId}&playlist_id=${playlistId}`, true);
    
            xhr.onload = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 201) {
                    showSuccessToast("Podcast berhasil dihapus dari playlist!");
                    
                }else{ // status code 200, some error
                    showErrorToast("Podcast gagal dihapus dari playlist!");
                }
            }
            }
            xhr.send(data);
        })
        })
    }
}
