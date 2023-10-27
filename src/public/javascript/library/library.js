"use strict"

import { showErrorToast, showSuccessToast } from "../toast.mjs";


document.addEventListener("DOMContentLoaded", (e) =>{

    const trashEl = document.querySelectorAll('.bx-trash');
    const playlistContainer = document.querySelector('.playlist-container')

    if(trashEl.length !== 0){
        trashEl.forEach(function(trash){
        trash.addEventListener("click", (e) => {
            e.preventDefault();
            
            const data = new FormData();
    
            const xhr = new XMLHttpRequest();

            data.append("id_podcast", trash.dataset.id);
            data.append("id_playlist", playlistContainer.dataset.id);
        
            xhr.open("POST", "/public/playlist", true);
    
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
});