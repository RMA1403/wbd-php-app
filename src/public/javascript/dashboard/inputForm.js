"use strict";

import { showErrorToast, showSuccessToast } from "../toast.mjs";

// Constants
const JUDUL_MAX_COUNT = 50;
const DESCRIPTION_MAX_COUNT = 1000;

// Get DOM elements
const formEl = document.getElementById("input-form");
const overlayEl = document.getElementById("overlay-form");

const audioInputButtonEl = document.getElementById("audio-input-btn");
const cancelFileButtonEl = document.getElementById("cancel-file-btn");
const changeCoverButtonEl = document.getElementById("change-cover-btn");
const saveButtonEl = document.getElementById("save-btn");
const categoryButtonEl = document.getElementById("category-input-btn");
const deleteButtonEl = document.getElementById("delete-btn");

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
categoryButtonEl &&
  categoryButtonEl.addEventListener("click", (e) => {
    e.preventDefault();

    categoryButtonEl.classList.toggle("focus");
    categoryChoicesEl.classList.toggle("hidden");
    overlayEl.classList.toggle("hidden");
  });

// Handle select 'category'
categoryButtonEl &&
  Array.from(categoryChoicesEl.children).forEach((el) => {
    el.addEventListener("click", (e) => {
      e.preventDefault();

      const category = el.children[0].innerHTML;
      categoryButtonEl.children[0].innerHTML = category;
      categoryInputEl.value = category;

      categoryButtonEl.classList.toggle("focus");
      categoryChoicesEl.classList.toggle("hidden");
      overlayEl.classList.toggle("hidden");
    });
  });

// Handle click outside 'category'
overlayEl.addEventListener("click", (e) => {
  e.preventDefault();

  categoryButtonEl.classList.toggle("focus");
  categoryChoicesEl.classList.toggle("hidden");
  overlayEl.classList.toggle("hidden");
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

// Handle delete
deleteButtonEl &&
  deleteButtonEl.addEventListener("click", (e) => {
    e.preventDefault();

    const idPodcast = new URLSearchParams(window.location.search).get(
      "id_podcast"
    );

    if (confirm("Are you sure?") === false) {
      return;
    }

    const xhr1 = new XMLHttpRequest();
    xhr1.open("DELETE", `/public/dashboard/podcast?id_podcast=${idPodcast}`);
    xhr1.send(null);

    xhr1.onreadystatechange = function () {
      if (xhr1.readyState === 4 && xhr1.status === 200) {
        showSuccessToast("Podcast deleted successfully!");
        setTimeout(() => {
          window.location.replace(`http://localhost:8080/public/dashboard`);
        }, 1000);
      }
    };
  });

// Handle submit form
saveButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  let idPodcast;
  let idEpisode;

  const audioFile = audioInputEl?.files[0];
  const imageFile = imageInputEl?.files[0];
  const title = judulInputEl.value;
  const description = descriptionInputEl.value;
  const category = categoryInputEl?.value;

  const formData = new FormData();
  const xhr = new XMLHttpRequest();

  switch (formEl.dataset.formType) {
    // Handle add new episode
    case "add-episode":
      idPodcast = new URLSearchParams(window.location.search).get("id_podcast");
      if (!idPodcast) {
        showErrorToast("Invalid URL");
        return;
      }

      if (!audioFile) {
        showErrorToast("Audio file must be provided");
        return;
      }

      if (!title) {
        showErrorToast("Title must be provided");
        return;
      }

      if (!imageFile) {
        showErrorToast("Cover image must be provided");
        return;
      }

      if (confirm("Save changes?") === false) {
        return;
      }

      xhr.open("POST", "/public/dashboard/add-episode");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 201) {
          showSuccessToast("Episode added successfully!");
          setTimeout(() => {
            window.location.replace(
              `http://localhost:8080/public/dashboard/episode?id_podcast=${idPodcast}`
            );
          }, 1000);
        }
      };

      formData.append("audioFile", audioFile);
      formData.append("imageFile", imageFile);
      formData.append("title", title);
      formData.append("description", description);
      formData.append("idPodcast", idPodcast);

      xhr.send(formData);
      break;

    // Handle edit episode
    case "edit-episode":
      idEpisode = new URLSearchParams(window.location.search).get("id_episode");
      idPodcast = new URLSearchParams(window.location.search).get("id_podcast");

      if (!idPodcast || !idEpisode) {
        showErrorToast("Invalid URL");
        return;
      }

      if (confirm("Save changes?") === false) {
        return;
      }

      xhr.open("POST", "/public/dashboard/edit-episode");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 201) {
          showSuccessToast("Episode updated successfully!");
          setTimeout(() => {
            window.location.replace(
              `http://localhost:8080/public/dashboard/episode?id_podcast=${idPodcast}`
            );
          }, 1000);
        }
      };

      if (imageFile) {
        formData.append("updateCover", true);
        formData.append("imageFile", imageFile);
      }

      formData.append("idEpisode", idEpisode);
      formData.append("title", title || judulInputEl.placeholder);
      formData.append(
        "description",
        description || descriptionInputEl.placeholder
      );

      xhr.send(formData);
      break;

    // Handle add new podcast
    case "add-podcast":
      if (!title) {
        showErrorToast("Title must be provided");
        return;
      }

      if (!category) {
        showErrorToast("Category must be provided");
        return;
      }

      if (!imageFile) {
        showErrorToast("Cover image must be provided");
        return;
      }

      if (confirm("Save changes?") === false) {
        return;
      }

      xhr.open("POST", "/public/dashboard/add-podcast");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 201) {
          showSuccessToast("Podcast added successfully!");
          setTimeout(() => {
            window.location.replace("http://localhost:8080/public/dashboard");
          }, 1000);
        }
      };

      formData.append("imageFile", imageFile);
      formData.append("title", title);
      formData.append("description", description);
      formData.append("category", category);

      xhr.send(formData);
      break;

    // Handle edit podcast
    case "edit-podcast":
      idPodcast = new URLSearchParams(window.location.search).get("id_podcast");

      if (!idPodcast) {
        showErrorToast("Invalid URL");
        return;
      }

      if (confirm("Save changes?") === false) {
        return;
      }

      xhr.open("POST", "/public/dashboard/edit-podcast");
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 201) {
          showSuccessToast("Podcast updated successfully!");
          setTimeout(() => {
            window.location.replace(
              `http://localhost:8080/public/dashboard/main?id_podcast=${idPodcast}`
            );
          }, 1000);
        }
      };

      if (imageFile) {
        formData.append("updateCover", true);
        formData.append("imageFile", imageFile);
      }

      formData.append("idPodcast", idPodcast);
      formData.append("title", title || judulInputEl.placeholder);
      formData.append(
        "description",
        description || descriptionInputEl.placeholder
      );

      xhr.send(formData);
      break;

    default:
      break;
  }
});
