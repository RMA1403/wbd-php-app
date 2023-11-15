import { handlePlayerPage } from "./player_page.js";

export function mountPlayer() {
    const player = document.querySelector(".player");

    const xhr = new XMLHttpRequest();
    // call Mount Player
    xhr.open("GET", "/public/components/player");

    xhr.onreadystatechange = () => {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        player.innerHTML = xhr.responseText;
        handlePlayerPage();
    }};

    xhr.send();

    
}
