"use strict";

// Get DOM elements
const playButtonsEl = document.querySelectorAll(".play-button");
const addLibraryButtonEl = document.getElementById("add-library-btn")
const libraryChoicesEl = document.getElementById("library-choices")
const overlayEl = document.getElementById("overlay-library")

// Handle play episode
Array.from(playButtonsEl).forEach((el) => {
  el.addEventListener("click", (e) => {
    e.preventDefault();

    console.log(`play episode id: ${el.dataset.id}`);
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
