const searchInput = document.getElementById('search-input');
const resultContainer = document.querySelector('.result-container');

const genreDisplay = document.querySelector('.genre-display');
const genreOptions = document.querySelectorAll('.genre-option');
const genreButton = document.querySelector('.genre-button');
const genreContent = document.querySelector('.genre-content');

const epsDisplay = document.querySelector('.eps-display');
const epsOptions = document.querySelectorAll('.eps-option');
const epsButton = document.querySelector('.eps-button');
const epsContent = document.querySelector('.eps-content');

const sortDisplay = document.querySelector('.sort-display');
const sortOptions = document.querySelectorAll('.sort-option');
const sortButton = document.querySelector('.sort-button');
const sortContent = document.querySelector('.sort-content');


console.log(epsDisplay);

var keyword = "";
var genre = "";
var sort = "";
var eps = "";
var isAsc = "true";

searchInput && 
    searchInput.addEventListener(
        "keyup",
        debounce(()=> {
            keyword = searchInput.value;
            const ajax = new XMLHttpRequest();

            ajax.onreadystatechange = () => {
                if(ajax.readyState == 4 && ajax.status == 200) {
                    resultContainer.innerHTML = ajax.responseText;
                    console.log("ajax amsterdam");
                }
            }

            ajax.open('GET', 
            `/public/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`, true);
            ajax.send();

        }, DEBOUNCE_TIMEOUT)
);


genreOptions.forEach(option => {
    option.addEventListener('click', function() {
        // Get the selected genre value
        const selectedGenre = option.innerHTML;
        
        // Update the button text with the selected genre
        genreDisplay.textContent = selectedGenre;
        
        
        genre = selectedGenre;
        const ajax = new XMLHttpRequest();

        ajax.onreadystatechange = () => {
            if(ajax.readyState == 4 && ajax.status == 200) {
                resultContainer.innerHTML = ajax.responseText;
            }
        }
        
        ajax.open('GET', 
        `/public/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`, true);
        ajax.send();

        genreContent.style.display = "none";
    });
});

genreButton.addEventListener('click', function() {
    genreContent.style.display = "block";
})


// FILTER BY EPS
epsOptions.forEach(option => {
    option.addEventListener('click', function() {
        // Get the selected eps value
        const selectedEps = option.innerHTML;
        
        // Update the button text with the selected eps
        epsDisplay.textContent = selectedEps;
        
        
        eps = selectedEps;
        const ajax = new XMLHttpRequest();

        ajax.onreadystatechange = () => {
            if(ajax.readyState == 4 && ajax.status == 200) {
                resultContainer.innerHTML = ajax.responseText;
            }
        }
        
        ajax.open('GET', 
        `/public/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`, true);
        ajax.send();

        epsContent.style.display = "none";
    });
});

epsButton.addEventListener('click', function() {
    epsContent.style.display = "block";
})

// FILTER BY EPS
sortOptions.forEach(option => {
    option.addEventListener('click', function() {
        // Get the selected sort value
        const selectedSort = option.innerHTML;
        
        // Update the button text with the selected sort
        sortDisplay.textContent = selectedSort;
        
        
        sort = selectedSort;
        const ajax = new XMLHttpRequest();

        ajax.onreadystatechange = () => {
            if(ajax.readyState == 4 && ajax.status == 200) {
                resultContainer.innerHTML = ajax.responseText;
            }
        }
        
        ajax.open('GET', 
        `/public/search?keyword=${keyword}&genre=${genre}&eps=${eps}&sort=${sort}&isAsc=${isAsc}`, true);
        ajax.send();

        sortContent.style.display = "none";
    });
});

sortButton.addEventListener('click', function() {
    sortContent.style.display = "block";
})