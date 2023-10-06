document.addEventListener("DOMContentLoaded", (e) => {
    const fullnameInput = document.getElementById('fullname');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const passwordConfirmedInput = document.getElementById('confirm-password');
    const registrationForm = document.getElementById('form-registration');
    const adminButton = document.getElementById('admin-radio');
    const userButton = document.getElementById('user-radio');
    const confirmPasswordAlert = document.getElementById('confirm-password-alert');
    const usernameAlert = document.getElementById('username-alert');
    const fullnameAlert = document.getElementById('fullname-alert');


    let fullnameValid = false;
    let usernameValid = false;
    let passwordConfirmedValid = false;

    fullnameInput && fullnameInput.addEventListener("keyup", () => {
        const fullname = fullnameInput.value;
        
        if(fullname.length > 50){
            fullnameAlert.innerText = "Fullname tidak bisa lebih dari 50 karakter";
            fullnameAlert.className = "alert-show";
            fullnameValid = false;
        }else{
            fullnameAlert.innerText = "";
            fullnameAlert.className = "alert-hide";
            fullnameValid = true;
        }
    })

    usernameInput && usernameInput.addEventListener("keyup", () => {
        const username = usernameInput.value;

        if(username.length > 50){
            usernameAlert.innerText = "Username tidak bisa lebih dari 50 karakter";
            usernameAlert.className = "alert-show";
            usernameValid = false;
        }else{
            usernameAlert.innerText = "";
            usernameAlert.className = "alert-hide";
            usernameValid = true;
        }
    })

    registrationForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const password = passwordInput.value;
        const passwordConfirmed = passwordConfirmedInput.value;

        passwordConfirmedValid = (password === passwordConfirmed);

        if(!passwordConfirmedValid){
            confirmPasswordAlert.innerText = "Password dan konfirmasi password tidak sesuai!";
            confirmPasswordAlert.className = "alert-show";
        }else{
            confirmPasswordAlert.innerText = "";
            confirmPasswordAlert.className = "alert-hide";
        }
        
        let isAdmin; 
        
        if(passwordConfirmedValid && usernameValid && fullnameValid){

            if(adminButton.checked){
                isAdmin = true;
            }else if(userButton.checked){
                isAdmin = false;
            }

            const formData = new FormData();
            formData.append("fullname", fullname);
            formData.append("username", username);
            formData.append("password", password);
            formData.append("isAdmin", isAdmin);

            const xhr = new XMLHttpRequest();

            xhr.open("POST", "/public/signup", true);

            xhr.onload = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 201) {
                        const data = JSON.parse(xhr.responseText);
                        location.replace(data.redirect_url);
                    }else{ //status code 200
                        usernameAlert.innerText = "Username tersebut telah terpakai!";
                        usernameAlert.className = "alert-show";
                    }
                }
            }
            xhr.send(formData);
        }
    })
})