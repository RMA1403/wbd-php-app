"use strict";

import { showErrorToast, showSuccessToast } from "../toast.mjs";

export function handleLibrary() {
        
        const blur = document.getElementById("blur");
        const popup = document.getElementById("popup");
        const main = document.querySelector("main");
        const playlistTitleInput = document.getElementById("playlist-title");
        const playlistTitleAlert = document.getElementById("playlist-title-alert");
        const addPlaylistForm = document.getElementById("add-playlist-form");
        const deletePlaylistEl = document.querySelectorAll(".bx-trash");
        const addPlaylistButton = document.querySelector(".new-playlist-btn");
        
        function toggle(){
            blur.classList.toggle('active');    
            popup.classList.toggle('active');
        }

        let playlistTitleValid = false;

        blur.addEventListener("click", (e) => {
            if(blur.classList.contains("active")){
                e.preventDefault();
                toggle();
            }
        });

        addPlaylistButton.addEventListener("click", function(e){
            toggle();
        })

        playlistTitleInput && playlistTitleInput.addEventListener("keyup", () => {
            const playlistTitle = playlistTitleInput.value;


            if(playlistTitle.length > 50){
                playlistTitleAlert.innerText = "Judul playlist tidak bisa lebih dari 50 karakter";
                playlistTitleAlert.className = "alert-show";
                playlistTitleValid = false;
            }else{
                playlistTitleAlert.innerText = "";
                playlistTitleAlert.className = "alert-hide";
                playlistTitleValid = true;
            }
        })

        addPlaylistForm.addEventListener("submit", (e) => {
            e.preventDefault();

            if(playlistTitleValid){

                const playlistTitle = playlistTitleInput.value;
        
                const data = new FormData();
                data.append("playlistTitle", playlistTitle);
        
                const xhr = new XMLHttpRequest();
        
                xhr.open("POST", "/public/library", true);
        
                xhr.onload = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 201) {
                            toggle();
                            showSuccessToast("Playlist berhasil dibuat!");
                            setTimeout(function(){
                                location.reload();
                            }, 500);
                        }else{ //status code 200
                            toggle();
                            showErrorToast("Terjadi kesalahan! Playlist gagal dibuat");
                        }
                    }
                }
                xhr.send(data);

            }
        })

        if(deletePlaylistEl.length !== 0){
            deletePlaylistEl.forEach(function(trash){
                trash.addEventListener("click", (e) => {
                    e.preventDefault();
                    const idPlaylist = trash.dataset.id;

                    const xhr = new XMLHttpRequest();

                    xhr.open("DELETE", `/public/library?playlist_id=${idPlaylist}`, true);

                    xhr.send(null);

                    xhr.onload = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 201) {
                                showSuccessToast("Playlist berhasil dihapus dari library!");
                                setTimeout(function(){
                                    location.reload();
                                }, 500);
                            }else{ //status code 200
                                showErrorToast("Playlist gagal dihapus dari library!");
                                console.log("ahai");
                            }
                        }
                    }
                })
            })
        }

}

// function toggle(){
//     const blur = document.getElementById("blur");
//     const popup = document.getElementById("popup");
//     blur.classList.toggle('active');
//     popup.classList.toggle('active');
// }

// document.addEventListener("DOMContentLoaded", function () {

//     const blurEl = document.getElementById("blur");
//     const main = document.querySelector("main");
//     const playlistTitleInput = document.getElementById("playlist-title");
//     const playlistTitleAlert = document.getElementById("playlist-title-alert");
//     const addPlaylistForm = document.getElementById("add-playlist-form");
//     const deletePlaylistEl = document.querySelectorAll(".bx-trash");

//     let playlistTitleValid = false;

//     main.addEventListener("click", (e) => {

//         if(blurEl.classList.contains("active")){
//             e.preventDefault();
//             toggle();
//         }
//     });

//     playlistTitleInput && playlistTitleInput.addEventListener("keyup", () => {
//         const playlistTitle = playlistTitleInput.value;


//         if(playlistTitle.length > 50){
//             playlistTitleAlert.innerText = "Judul playlist tidak bisa lebih dari 50 karakter";
//             playlistTitleAlert.className = "alert-show";
//             playlistTitleValid = false;
//         }else{
//             playlistTitleAlert.innerText = "";
//             playlistTitleAlert.className = "alert-hide";
//             playlistTitleValid = true;
//         }
//     })
    

//     addPlaylistForm.addEventListener("submit", (e) => {
//         e.preventDefault();
//         console.log("testing");

//         if(playlistTitleValid){

//             const playlistTitle = playlistTitleInput.value;
    
//             const data = new FormData();
//             data.append("playlistTitle", playlistTitle);
    
//             const xhr = new XMLHttpRequest();
    
//             xhr.open("POST", "/public/library", true);
    
//             xhr.onload = function () {
//                 if (xhr.readyState === XMLHttpRequest.DONE) {
//                     if (xhr.status === 201) {
//                         toggle();
//                         location.reload();
//                     }else{ //status code 200
//                         toggle();
//                         alert("Ada yang aneh");
//                     }
//                 }
//             }
//             xhr.send(data);

//         }
//     })

//     if(deletePlaylistEl.length !== 0){
//         deletePlaylistEl.forEach(function(trash){
//             trash.addEventListener("click", (e) => {
//                 e.preventDefault();
//                 const idPlaylist = trash.dataset.id;

//                 const xhr = new XMLHttpRequest();

//                 xhr.open("DELETE", `/public/library?playlist_id=${idPlaylist}`, true);

//                 xhr.send(null);

//                 xhr.onload = function () {
//                     if (xhr.readyState === XMLHttpRequest.DONE) {
//                         if (xhr.status === 201) {
//                             // showSuccessToast("Playlist berhasil dihapus dari library!");
//                             setTimeout(function(){
//                                 location.reload();
//                             }, 500);
//                         }else{ //status code 200
//                             // showErrorToast("Playlist gagal dihapus dari library!");
//                             console.log("ahai");
//                         }
//                     }
//                 }
//             })
//         })
//     }



//   });

