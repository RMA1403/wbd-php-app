import { handleDashboard } from "../dashboard/layout.mjs";
import { handlePlaylist } from "../library/library.mjs";
import { handleLibrary } from "../library/library2.mjs";
import { handleSearch } from "../search/search.js";
import { handleResultSearch } from "../search/resultSearch.js";
import { handlePodcast } from "../podcast/script.js";
import { handleHome } from "../home/home.js";
import { mountPlayer } from "../player/player.js";

const mainSection = document.querySelector("#main-section");
const sidebar = document.querySelector(".sidebar");

const sidebarHome = document.getElementById("sidebar-home");
const sidebarSearch = document.getElementById("sidebar-search");
const sidebarLibrary = document.getElementById("sidebar-library");
const sidebarDashboard = document.getElementById("sidebar-dashboard");

const urls = window.location.href.split("?")[0].split("/");
let lastURL = urls[urls.length - 1];

const queryParam = window.location.href.split("?")[1] || "";

window.onload = () => {
  getPage(lastURL, queryParam);
};

const getPage = (page, queryParam) => {
  const query = queryParam !== "" ? "?" + queryParam : queryParam;

  const xhr = new XMLHttpRequest();
  xhr.open("GET", `/public/components/${page}${query}`, true);

  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      mainSection.innerHTML = xhr.responseText;
      if (window.location.href.includes("dashboard")) {
        handleDashboard();
      } else if(window.location.href.includes("library")){
        handleLibrary();
      } else if(window.location.href.includes("playlist")){
        handlePlaylist();
      } else if (window.location.href.includes("search")) {
        handleSearch();
        handleResultSearch();
      } else if (window.location.href.includes("podcast")) {
        handlePodcast();
      } else if (window.location.href.includes("home")) {
        handleHome();
      }
      if (!document.querySelector(".hide-player")) {
        mountPlayer();
      }
    }
  };

  xhr.send();
  history.pushState({}, "", `http://localhost:8080/public/${page}${query}`);
};

sidebarHome && sidebarHome.addEventListener("click", () => getPage("home", ""));
sidebarSearch &&
  sidebarSearch.addEventListener("click", () => getPage("search", ""));
sidebarLibrary &&
  sidebarLibrary.addEventListener("click", () => getPage("library", ""));
sidebarDashboard &&
  sidebarDashboard.addEventListener("click", () => getPage("dashboard", ""));
