document.addEventListener("DOMContentLoaded", (e) => {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const loginForm = document.getElementById('login-form');
    const loginAlert = document.getElementById('login-alert');

    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const username = usernameInput.value;
        const password = passwordInput.value;

        const formData = new FormData();
        formData.append("username", username);
        formData.append("password", password);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/public/login", true);

        xhr.onload = function(){
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 201){
                    const data = JSON.parse(xhr.responseText);
                    location.replace(data.redirect_url);
                }else{ // password dan username tidak sesuai
                    loginAlert.innerText = "Password dan username tidak sesuai!";
                    loginAlert.className = "alert-show";
                }
            }
        }

        xhr.send(formData);
    })
    
})