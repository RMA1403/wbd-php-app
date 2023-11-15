import { handleResultSearch} from "./resultSearch.js";

export const handleSearch = () => {
  const searchInput = document.getElementById("search-input");
  const resultContainer = document.querySelector(".result-container");

  const genreDisplay = document.querySelector(".genre-display");
  const genreOptions = document.querySelectorAll(".genre-option");
  const genreButton = document.querySelector(".genre-button");
  const genreContent = document.querySelector(".genre-content");

  const epsDisplay = document.querySelector(".eps-display");
  const epsOptions = document.querySelectorAll(".eps-option");
  const epsButton = document.querySelector(".eps-button");
  const epsContent = document.querySelector(".eps-content");

  const sortDisplay = document.querySelector(".sort-display");
  const sortOptions = document.querySelectorAll(".sort-option");
  const sortButton = document.querySelector(".sort-button");
  const sortContent = document.querySelector(".sort-content");

  const defaultGenre = "";
  const defaultEps = "";
  const defaultSort = "";
  const defaultIsAsc = "true";

  var keyword = "";
  var genre = defaultGenre;
  var sort = defaultSort;
  var eps = defaultEps;
  var isAsc = defaultIsAsc;

  searchInput &&
    searchInput.addEventListener(
      "keyup",
      debounce(() => {
        keyword = searchInput.value;
        const ajax = new XMLHttpRequest();

        ajax.onreadystatechange = () => {
          if (ajax.readyState == 4 && ajax.status == 200) {
            resultContainer.innerHTML = ajax.responseText;
            handleResultSearch();
          }
        };

        ajax.open(
          "GET",
          `/public/components/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`,
          true
        );
        ajax.send();
      }, DEBOUNCE_TIMEOUT)
    );

  // FILTER BY GENRE
  genreButton &&
    genreButton.addEventListener("click", function () {
      genreContent.style.display = "block";
    });

  genreOptions.forEach((option) => {
    option.addEventListener("click", function () {
      // Get the selected genre value
      const selectedGenre = option.innerHTML;

      // Update the button text with the selected genre
      genreDisplay.textContent = selectedGenre;
      if (selectedGenre === "All genre") {
        genre = "";
      } else {
        genre = selectedGenre;
      }
      const ajax = new XMLHttpRequest();

      ajax.onreadystatechange = () => {
        if (ajax.readyState == 4 && ajax.status == 200) {
          resultContainer.innerHTML = ajax.responseText;
          handleResultSearch();
        }
      };

      ajax.open(
        "GET",
        `/public/components/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`,
        true
      );
      ajax.send();

      genreContent.style.display = "none";
    });
  });

  // FILTER BY EPS
  epsOptions.forEach((option) => {
    option.addEventListener("click", function () {
      // Get the selected eps value
      const selectedEps = option.innerHTML;

      // Update the button text with the selected eps
      epsDisplay.textContent = selectedEps;

      if (selectedEps === "All eps") {
        eps = "";
      } else {
        eps = selectedEps;
      }
      const ajax = new XMLHttpRequest();

      ajax.onreadystatechange = () => {
        if (ajax.readyState == 4 && ajax.status == 200) {
          resultContainer.innerHTML = ajax.responseText;
          handleResultSearch();
        }
      };

      ajax.open(
        "GET",
        `/public/components/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`,
        true
      );
      ajax.send();

      epsContent.style.display = "none";
    });
  });

  epsButton &&
    epsButton.addEventListener("click", function () {
      epsContent.style.display = "block";
    });

  // FILTER BY EPS
  sortOptions.forEach((option) => {
    option.addEventListener("click", function () {
      // Get the selected sort value
      const selectedSort = option.innerHTML;

      // Update the button text with the selected sort
      sortDisplay.textContent = selectedSort;

      sort = selectedSort;
      const ajax = new XMLHttpRequest();

      ajax.onreadystatechange = () => {
        if (ajax.readyState == 4 && ajax.status == 200) {
          resultContainer.innerHTML = ajax.responseText;
          handleResultSearch();
        }
      };

      ajax.open(
        "GET",
        `/public/components/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`,
        true
      );
      ajax.send();

      sortContent.style.display = "none";
    });
  });

  sortButton &&
    sortButton.addEventListener("click", function () {
      sortContent.style.display = "block";
    });

  window.addEventListener("click", function (e) {
    if (!genreButton.contains(e.target)) {
      genreContent.style.display = "none";
    }
    if (!epsButton.contains(e.target)) {
      epsContent.style.display = "none";
    }
    if (!sortButton.contains(e.target)) {
      sortContent.style.display = "none";
    }
  });
};
