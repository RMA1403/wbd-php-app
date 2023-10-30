"use strict";

import { showSuccessToast, showErrorToast, showInformationToast } from "../toast.mjs";

// Get DOM elements
const playButtonsEl = document.querySelectorAll(".play-button");
const addLibraryButtonEl = document.getElementById("add-library-btn")
const libraryChoicesEl = document.getElementById("library-choices")
const overlayEl = document.getElementById("overlay-library")
const playlists = document.querySelectorAll(".playlist");

// Handle play episode
Array.from(playButtonsEl).forEach((el) => {
  el.addEventListener("click", (e) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append("idEpisode", el.dataset.id);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/public/episode/play");

    xhr.onreadystatechange = () => {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      }
    };

    xhr.send(formData);
  });
});

// Handle open 'library' input
addLibraryButtonEl &&
  addLibraryButtonEl.addEventListener("click", (e) => {
    e.preventDefault();

    libraryChoicesEl.classList.toggle("hidden");
    overlayEl.classList.toggle("hidden");
  });

// Handle click outside 'library'
overlayEl.addEventListener("click", (e) => {
  e.preventDefault();

  libraryChoicesEl.classList.toggle("hidden");
  overlayEl.classList.toggle("hidden");
});


if(playlists.length !== 0){
  playlists.forEach(function(playlist){
    playlist.addEventListener("click", (e) => {
      e.preventDefault();
      
      const data = new FormData();

      const xhr = new XMLHttpRequest();
  
      xhr.open("POST", "/public/podcast", true);
      
      data.append("id_playlist", playlist.dataset.id);
      data.append("id_podcast", libraryChoicesEl.dataset.idPodcast); 

      xhr.onload = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                showSuccessToast("Podcast berhasil ditambahkan ke playlist!");
            }else if(xhr.status === 203){
                showInformationToast("Podcast sudah ada dalam playlist!")
            }
            else{ // status code 200, some other error
                showErrorToast("Podcast gagal ditambahkan ke playlist!");
            }
        }
      }
      xhr.send(data);
    })
  })
}