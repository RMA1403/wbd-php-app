"use strict";

import { showSuccessToast } from "../toast.mjs";

// Get DOM elements
const dashboardLink = document.getElementById("dashboard-link");
const episodeLink = document.getElementById("episode-link");
const dashboardSection = document.getElementById("dashboard-section");

const overlayEl = document.getElementById("overlay-layout");
const choosePodcastButtonEl = document.getElementById("choose-podcast-btn");
const podcastChoicesEl = document.getElementById("podcast-choices");

const urls = window.location.href.split("?")[0].split("/");
let lastURL = urls[urls.length - 1];

let idPodcast = new URLSearchParams(window.location.search).get("id_podcast");
let page = new URLSearchParams(window.location.search).get("page");
let podcasts = [];

// Initial request to fetch user podcasts
const xhr = new XMLHttpRequest();
xhr.open("GET", "/public/dashboard/user-podcast");
xhr.send(null);

xhr.onreadystatechange = () => {
  if (xhr.readyState === 4 && xhr.status === 200) {
    const resJson = JSON.parse(xhr.response);

    podcasts = resJson?.podcasts;
    // Redirect if the user doesnt have any podcast
    if (podcasts.length === 0) {
      window.location.replace("/public/dashboard/add-podcast");
      return;
    }

    if (!idPodcast) {
      idPodcast = podcasts[0].id_podcast;
    }

    if (lastURL === "dashboard") {
      lastURL = "main";
    }

    if (lastURL === "main") {
      dashboardLink.classList.add("nav-active");
    } else {
      episodeLink.classList.add("nav-active");
    }

    // Get main content
    const xhr2 = new XMLHttpRequest();
    xhr2.open(
      "GET",
      `/public/dashboard/internal/${lastURL}?id_podcast=${idPodcast}${
        lastURL === "episode" ? `&page=${page || 1}` : ""
      }`
    );
    xhr2.send(null);

    xhr2.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE) {
        dashboardSection.innerHTML = this.response;

        const deleteEpisodeButtonEl = document.querySelectorAll(
          ".delete-episode-btn"
        );
        Array.from(deleteEpisodeButtonEl).forEach((el) => {
          el.addEventListener("click", (e) => {
            e.preventDefault();

            handleDeleteEpisode(el.dataset.id);
          });
        });

        const allEpisodeButtonEl = document.getElementById("all-episode-btn");
        allEpisodeButtonEl &&
          allEpisodeButtonEl.addEventListener("click", changeToEpisode);
      }
    };

    history.pushState(
      {},
      "",
      `/public/dashboard/${lastURL}?id_podcast=${idPodcast}${
        lastURL === "episode" ? `&page=${page || 1}` : ""
      }`
    );
  }
};

// Add event listeners to dashboard nav
episodeLink.addEventListener("click", changeToEpisode);
dashboardLink.addEventListener("click", changeToMain);

overlayEl.addEventListener("click", (e) => {
  e.preventDefault();

  podcastChoicesEl.classList.toggle("hidden");
  overlayEl.classList.toggle("hidden");
});
choosePodcastButtonEl.addEventListener("click", (e) => {
  e.preventDefault();

  podcastChoicesEl.classList.toggle("hidden");
  overlayEl.classList.toggle("hidden");
});

// Handles change to episode page
function changeToEpisode() {
  history.pushState(
    {},
    "",
    `http://localhost:8080/public/dashboard/episode?id_podcast=${idPodcast}&page=1`
  );

  dashboardLink.classList.toggle("nav-active");
  episodeLink.classList.toggle("nav-active");

  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `/public/dashboard/internal/episode?id_podcast=${idPodcast}&page=1`
  );
  xhr.send(null);

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      dashboardSection.innerHTML = this.response;

      const deleteEpisodeButtonEl = document.querySelectorAll(
        ".delete-episode-btn"
      );
      Array.from(deleteEpisodeButtonEl).forEach((el) => {
        el.addEventListener("click", (e) => {
          e.preventDefault();

          handleDeleteEpisode(el.dataset.id);
        });
      });
    }
  };
}

// Handles change to main page
function changeToMain() {
  history.pushState(
    {},
    "",
    `http://localhost:8080/public/dashboard/main?id_podcast=${idPodcast}`
  );

  dashboardLink.classList.toggle("nav-active");
  episodeLink.classList.toggle("nav-active");

  const xhr1 = new XMLHttpRequest();
  xhr1.open("GET", `/public/dashboard/internal/main?id_podcast=${idPodcast}`);
  xhr1.send(null);

  xhr1.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      dashboardSection.innerHTML = this.response;

      const allEpisodeButtonEl = document.getElementById("all-episode-btn");
      allEpisodeButtonEl &&
        allEpisodeButtonEl.addEventListener("click", changeToEpisode);
    }
  };
}

// Handle delete episode
function handleDeleteEpisode(idEpisode) {
  if (confirm("Are you sure?") === false) {
    return;
  }

  const xhr1 = new XMLHttpRequest();
  xhr1.open("DELETE", `/public/dashboard/episode?id_episode=${idEpisode}`);
  xhr1.send(null);

  xhr1.onreadystatechange = function () {
    if (xhr1.readyState === 4 && xhr1.status === 200) {
      showSuccessToast("Episode deleted successfully!");

      const xhr2 = new XMLHttpRequest();
      xhr2.open(
        "GET",
        `/public/dashboard/internal/episode?id_podcast=${idPodcast}&page=1`
      );
      xhr2.send(null);

      xhr2.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
          dashboardSection.innerHTML = this.response;

          const deleteEpisodeButtonEl = document.querySelectorAll(
            ".delete-episode-btn"
          );
          Array.from(deleteEpisodeButtonEl).forEach((el) => {
            el.addEventListener("click", (e) => {
              e.preventDefault();

              handleDeleteEpisode(el.dataset.id);
            });
          });
        }
      };
    }
  };
}
