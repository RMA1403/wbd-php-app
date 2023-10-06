"use strict";

import { showErrorToast, showInformationToast, showSuccessToast } from "../toast.mjs";

// Constants
const JUDUL_MAX_COUNT = 50;
const DESCRIPTION_MAX_COUNT = 1000;

// Get DOM elements
const formEl = document.getElementById("input-form");
const overlayEl = document.getElementById("overlay")

const audioInputButtonEl = document.getElementById("audio-input-btn");
const cancelFileButtonEl = document.getElementById("cancel-file-btn");
const changeCoverButtonEl = document.getElementById("change-cover-btn");
const saveButtonEl = document.getElementById("save-btn");
const categoryButtonEl = document.getElementById("category-input-btn");

const audioInputEl = document.getElementById("audio-input");
const judulInputEl = document.getElementById("judul-input");
const descriptionInputEl = document.getElementById("description-input");
const imageInputEl = document.getElementById("image-input");
const categoryInputEl = document.getElementById("category-input");

const fileNameEl = document.getElementById("file-name");
const fileNameContainerEl = document.querySelector(".file-name-container");
const judulCountEl = document.getElementById("judul-count");
const descriptionCountEl = document.getElementById("description-count");
const coverImageEl = document.getElementById("cover-image");
const categoryChoicesEl = document.getElementById("category-choices");

// Handle user file input
audioInputEl &&
  audioInputEl.addEventListener("change", (e) => {
    e.preventDefault();

    fileNameEl.innerHTML = audioInputEl.files[0].name;

    fileNameContainerEl.classList.toggle("hidden");
    audioInputButtonEl.classList.add("hidden");
  });

// Handle open file input window
audioInputButtonEl &&
  audioInputButtonEl.addEventListener("click", (e) => {
    e.preventDefault();

    audioInputEl.click();
  });

// Handle cancel file selection
cancelFileButtonEl &&
  cancelFileButtonEl.addEventListener("click", (e) => {
    e.preventDefault();

    fileNameEl.innerHTML = null;
    audioInputEl.value = null;

    fileNameContainerEl.classList.toggle("hidden");
    audioInputButtonEl.classList.remove("hidden");
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

// Handle 'description' input
descriptionCountEl.innerHTML = descriptionInputEl.value.length;
let prevDescriptionVal = "";
descriptionInputEl.addEventListener("input", (e) => {
  e.preventDefault();

  if (descriptionInputEl.value.length > DESCRIPTION_MAX_COUNT) {
    descriptionInputEl.value = prevDescriptionVal;
  } else {
    descriptionCountEl.innerHTML = descriptionInputEl.value.length;
    prevDescriptionVal = descriptionInputEl.value;
  }
});

// Handle open 'category' input
categoryButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  categoryButtonEl.classList.toggle("focus");
  categoryChoicesEl.classList.toggle("hidden");
});

// Handle select 'category'
Array.from(categoryChoicesEl.children).forEach((el) => {
  el.addEventListener("click", (e) => {
    e.preventDefault();

    const category = el.children[0].innerHTML
    categoryButtonEl.children[0].innerHTML = category
    categoryInputEl.value = category

    categoryButtonEl.classList.toggle("focus");
    categoryChoicesEl.classList.toggle("hidden");
  });
});

// Handle click change cover image
changeCoverButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  imageInputEl.click();
});

// Handle cover image change
imageInputEl.addEventListener("change", (e) => {
  e.preventDefault();

  if (imageInputEl.files[0]) {
    coverImageEl.src = URL.createObjectURL(imageInputEl.files[0]);
  }
});

// Handle save episode
saveButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  showSuccessToast("Episode berhasil ditambahkan")

  const audioFile = audioInputEl?.files[0];
  const imageFile = imageInputEl?.files[0];
  const title = judulInputEl.value;
  const description = descriptionInputEl.value;
  const category = categoryInputEl.value

  const formData = new FormData();
  const xhr = new XMLHttpRequest();
  console.log(categoryInputEl.value)
  switch (formEl.dataset.formType) {
    case "episode":
      xhr.open("POST", "/public/dashboard/add-episode");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 201) {
          console.log(xhr.responseText);
        }
      };

      formData.append("audioFile", audioFile);
      formData.append("imageFile", imageFile);
      formData.append("title", title);
      formData.append("description", description);

      xhr.send(formData);
      break;

    case "podcast":
      break;

    default:
      console.log("TEST");
      break;
  }
});
