"use strict";

console.log("MASUK");

const dashboardLink = document.getElementById("dashboard-link");
const episodeLink = document.getElementById("episode-link");
const dashboardSection = document.getElementById("dashboard-section");

const urls = window.location.href.split("?")[0].split("/");
let lastURL = urls[urls.length - 1];

if (lastURL === "dashboard") {
  history.pushState({}, "", "http://localhost:8080/public/dashboard/internal/main?user_id=1");
  lastURL = "main"
}

if (lastURL === "main") {
  dashboardLink.classList.add("nav-active");
} else {
  episodeLink.classList.add("nav-active");
}
const xhr = new XMLHttpRequest();
xhr.open("GET", `/public/dashboard/internal/${lastURL}?user_id=1`);
xhr.send(null);

xhr.onreadystatechange = function () {
  if (this.readyState === XMLHttpRequest.DONE) {
    dashboardSection.innerHTML = this.response;
  }
};

episodeLink.addEventListener("click", () => {
  history.pushState({}, "", "http://localhost:8080/public/dashboard/episode?user_id=1");

  dashboardLink.classList.toggle("nav-active");
  episodeLink.classList.toggle("nav-active");

  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/public/dashboard/internal/episode");
  xhr.send(null);

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      console.log(this.response);
      dashboardSection.innerHTML = this.response;
    }
  };
});

dashboardLink.addEventListener("click", () => {
  history.pushState(
    {},
    "",
    "http://localhost:8080/public/dashboard/main?user_id=1"
  );

  dashboardLink.classList.toggle("nav-active");
  episodeLink.classList.toggle("nav-active");

  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/public/dashboard/internal/main?user_id=1");
  xhr.send(null);

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      console.log(this.response);
      dashboardSection.innerHTML = this.response;
    }
  };
});
