const searchInput = document.getElementById('search-input');
const resultContainer = document.querySelector('.result-container');

const genreDropdown = document.querySelector('.genre');
const genreDisplay = document.querySelector('.genre-display');
const genreOptions = document.querySelectorAll('.genre-option');

console.log(genreOptions);

var keyword = "";
var genre = "";

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
            `/public/search?keyword=${keyword}&genre=${genre}`, true);
            ajax.send();

        }, DEBOUNCE_TIMEOUT)
);


genreOptions.forEach(option => {
    option.addEventListener('click', function() {
        // Get the selected genre value
        const selectedGenre = option.getAttribute('data-value');
        
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
        `/public/search?keyword=${keyword}&genre=${genre}`, true);
        ajax.send();
    });
});