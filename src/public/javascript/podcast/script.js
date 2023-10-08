"use strict";

// Get DOM elements
const playButtonsEl = document.querySelectorAll(".play-button");

Array.from(playButtonsEl).forEach((el) => {
  el.addEventListener("click", (e) => {
    e.preventDefault();

    console.log(`play episode id: ${el.dataset.id}`);
  });
});
