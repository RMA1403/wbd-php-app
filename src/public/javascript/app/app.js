import { handleDashboard } from "../dashboard/layout.mjs";

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
      // handleSearch();
      if (window.location.href.includes("dashboard")) {
        handleDashboard();
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
