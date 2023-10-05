"use strict";

// Constants
const JUDUL_MAX_COUNT = 100;

// Get DOM elements
const fileInputButtonEl = document.getElementById("file-input-btn");
const cancelFileButtonEl = document.getElementById("cancel-file-btn");

const fileInputEl = document.getElementById("file-input");
const judulInputEl = document.getElementById("judul-input");

const fileNameEl = document.getElementById("file-name");
const fileNameContainerEl = document.querySelector(".file-name-container");
const judulCountEl = document.getElementById("judul-count");

let file = null;
// Handle user file input
fileInputEl.addEventListener("change", (e) => {
  e.preventDefault();

  file = fileInputEl.files[0];
  fileNameEl.innerHTML = file.name;

  fileNameContainerEl.classList.toggle("hidden");
  fileInputButtonEl.classList.add("hidden");
});

// Handle open file input window
fileInputButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  fileInputEl.click();
});

// Handle cancel file selection
cancelFileButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  file = null;
  fileNameEl.innerHTML = null;
  fileInputEl.value = null;

  fileNameContainerEl.classList.toggle("hidden");
  fileInputButtonEl.classList.remove("hidden");
});

// Handle 'judul' input
judulCountEl.innerHTML = judulInputEl.value.length;
let prevJudulVal = "";
judulInputEl.addEventListener("input", (e) => {
  e.preventDefault();

  if (judulInputEl.value.length > JUDUL_MAX_COUNT) {
    judulInputEl.value = prevJudulVal;
  } else {
    judulCountEl.innerHTML = judulInputEl.value.length;
    prevJudulVal = judulInputEl.value;
  }
});
