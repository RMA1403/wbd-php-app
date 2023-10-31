const mainSection = document.querySelector('main');
const sidebar = document.querySelector('.sidebar');

const urls = window.location.href.split("?")[0].split("/");
let lastURL = urls[urls.length - 1];

window.onload = () => {
    getPage(lastURL);
}

getPage = (page) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/public/components/${page}`, true);

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            mainSection.innerHTML = xhr.responseText;
            handleSearch();
            handleDashboard();
        }
    }

    xhr.send();
    history.pushState(
        {},
        "",
        `http://localhost:8080/public/${page}`
    );
}   
