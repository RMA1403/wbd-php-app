document.addEventListener("DOMContentLoaded", (e) => {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const loginForm = document.getElementById('login-form');
    const loginAlert = document.getElementById('login-alert');
    const usernameAlert = document.getElementById('username-alert');

    let usernameValid = false; 

    usernameInput && usernameInput.addEventListener("keyup", () => {
        const username = usernameInput.value;

        if(username.length > 50){
            usernameAlert.innerText = "Username tidak mungkin lebih dari 50 karakter";
            usernameAlert.className = "alert-show";
            usernameValid = false;
        }else{
            usernameAlert.innerText = "";
            usernameAlert.className = "alert-hide";
            usernameValid = true;
        }
    })

    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();

        if(usernameValid){
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
        }
    })
    
})