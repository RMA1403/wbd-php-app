const searchInput = document.getElementById('search-input');
const resultContainer = document.querySelector('.result-container');

const keyword = "";
const genre = "all";

searchInput && 
    searchInput.addEventListener(
        "keyup",
        debounce(()=> {
            keyword = searchInput.value;
            const ajax = new XMLHttpRequest();

            ajax.onreadystatechange = () => {
                if(ajax.readyState == 4 && ajax.status == 200) {
                    resultContainer.innerHTML = ajax.responseText;
                }
            }

            ajax.open('GET', 
            `/public/search?keyword=${keyword}?genre=${genre}`, true);
            ajax.send();

        }, DEBOUNCE_TIMEOUT)
);