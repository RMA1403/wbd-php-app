"use strict";

import { showSuccessToast } from "../toast.mjs";

// Get DOM elements
const dashboardLink = document.getElementById("dashboard-link");
const episodeLink = document.getElementById("episode-link");
const dashboardSection = document.getElementById("dashboard-section");

const urls = window.location.href.split("?")[0].split("/");
let lastURL = urls[urls.length - 1];

let idPodcast = new URLSearchParams(window.location.search).get("id_podcast");
const idUser = new URLSearchParams(window.location.search).get("id_user");

function redirectLayout() {
  if (lastURL === "main" || lastURL === "dashboard") {
    dashboardLink.classList.add("nav-active");
  } else {
    episodeLink.classList.add("nav-active");
  }

  if (lastURL === "dashboard") {
    lastURL = "main";
  }

  if (!idPodcast) {
    const xhr1 = new XMLHttpRequest();
    xhr1.open("GET", `/public/dashboard/user-podcast?id_user=${idUser}`);
    xhr1.send(null);

    xhr1.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE) {
        const resJson = JSON.parse(this.response);

        idPodcast = resJson?.podcast?.id_podcast;
        const xhr2 = new XMLHttpRequest();

        xhr2.open(
          "GET",
          `/public/dashboard/internal/${lastURL}?id_user=${idUser}&id_podcast=${idPodcast}`
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

            const allEpisodeButtonEl =
              document.getElementById("all-episode-btn");
            allEpisodeButtonEl &&
              allEpisodeButtonEl.addEventListener("click", () => {
                history.pushState(
                  {},
                  "",
                  `http://localhost:8080/public/dashboard/episode?id_user=${idUser}${
                    idPodcast ? `&id_podcast=${idPodcast}` : ""
                  }`
                );

                dashboardLink.classList.toggle("nav-active");
                episodeLink.classList.toggle("nav-active");

                const xhr3 = new XMLHttpRequest();
                xhr3.open(
                  "GET",
                  `/public/dashboard/internal/episode?id_user=${idUser}${
                    idPodcast ? `&id_podcast=${idPodcast}` : ""
                  }`
                );
                xhr3.send(null);

                xhr3.onreadystatechange = function () {
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
              });
          }
        };

        history.pushState(
          {},
          "",
          `/public/dashboard/${lastURL}?id_user=${idUser}&id_podcast=${idPodcast}`
        );
      }
    };
  } else {
    const xhr = new XMLHttpRequest();

    xhr.open(
      "GET",
      `/public/dashboard/internal/${lastURL}?id_user=${idUser}&id_podcast=${idPodcast}`
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

        const allEpisodeButtonEl = document.getElementById("all-episode-btn");
        allEpisodeButtonEl &&
          allEpisodeButtonEl.addEventListener("click", () => {
            history.pushState(
              {},
              "",
              `http://localhost:8080/public/dashboard/episode?id_user=${idUser}${
                idPodcast ? `&id_podcast=${idPodcast}` : ""
              }`
            );

            dashboardLink.classList.toggle("nav-active");
            episodeLink.classList.toggle("nav-active");

            const xhr3 = new XMLHttpRequest();
            xhr3.open(
              "GET",
              `/public/dashboard/internal/episode?id_user=${idUser}${
                idPodcast ? `&id_podcast=${idPodcast}` : ""
              }`
            );
            xhr3.send(null);

            xhr3.onreadystatechange = function () {
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
          });
      }
    };

    history.pushState(
      {},
      "",
      `/public/dashboard/${lastURL}?id_user=${idUser}&id_podcast=${idPodcast}`
    );
  }
}

redirectLayout();

episodeLink.addEventListener("click", () => {
  history.pushState(
    {},
    "",
    `http://localhost:8080/public/dashboard/episode?id_user=${idUser}${
      idPodcast ? `&id_podcast=${idPodcast}` : ""
    }`
  );

  dashboardLink.classList.toggle("nav-active");
  episodeLink.classList.toggle("nav-active");

  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `/public/dashboard/internal/episode?id_user=${idUser}${
      idPodcast ? `&id_podcast=${idPodcast}` : ""
    }`
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
});

dashboardLink.addEventListener("click", () => {
  history.pushState(
    {},
    "",
    `http://localhost:8080/public/dashboard/main?id_user=${idUser}${
      idPodcast ? `&id_podcast=${idPodcast}` : ""
    }`
  );

  dashboardLink.classList.toggle("nav-active");
  episodeLink.classList.toggle("nav-active");

  const xhr1 = new XMLHttpRequest();
  xhr1.open(
    "GET",
    `/public/dashboard/internal/main?id_user=${idUser}${
      idPodcast ? `&id_podcast=${idPodcast}` : ""
    }`
  );
  xhr1.send(null);

  xhr1.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      dashboardSection.innerHTML = this.response;

      const allEpisodeButtonEl = document.getElementById("all-episode-btn");
      allEpisodeButtonEl &&
        allEpisodeButtonEl.addEventListener("click", () => {
          history.pushState(
            {},
            "",
            `http://localhost:8080/public/dashboard/episode?id_user=${idUser}${
              idPodcast ? `&id_podcast=${idPodcast}` : ""
            }`
          );

          dashboardLink.classList.toggle("nav-active");
          episodeLink.classList.toggle("nav-active");

          const xhr2 = new XMLHttpRequest();
          xhr2.open(
            "GET",
            `/public/dashboard/internal/episode?id_user=${idUser}${
              idPodcast ? `&id_podcast=${idPodcast}` : ""
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
            }
          };
        });
    }
  };
});

// Handle delete episode
function handleDeleteEpisode(idEpisode) {
  if (confirm("Are you sure?") === false) {
    return;
  }

  const xhr1 = new XMLHttpRequest();
  xhr1.open(
    "DELETE",
    `/public/dashboard/episode?id_user=${idUser}
      &id_episode=${idEpisode}`
  );
  xhr1.send(null);

  xhr1.onreadystatechange = function () {
    if (xhr1.readyState === 4 && xhr1.status === 200) {
      showSuccessToast("Episode deleted successfully!");

      const xhr2 = new XMLHttpRequest();
      xhr2.open(
        "GET",
        `/public/dashboard/internal/episode?id_user=${idUser}${
          idPodcast ? `&id_podcast=${idPodcast}` : ""
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
        }
      };
    }
  };
}
