"use strict";

// Get DOM elements
const playButtonsEl = document.querySelectorAll(".play-button");
const addLibraryButtonEl = document.getElementById("add-library-btn");
const libraryChoicesEl = document.getElementById("library-choices");
const overlayEl = document.getElementById("overlay-library");

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
