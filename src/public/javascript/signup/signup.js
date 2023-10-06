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

    registrationForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const password = passwordInput.value;
        const passwordConfirmed = passwordConfirmedInput.value;
        
        let isAdmin; 
        
        // validasi konfirmasi password
        if(password === passwordConfirmed){
            const username = usernameInput.value;
            const fullname = fullnameInput.value;

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
                        if(confirmPasswordAlert.innerText !== ""){
                            confirmPasswordAlert.innerText = "";
                            confirmPasswordAlert.className = "alert-hide";
                        }
                    }
                }
            }
            xhr.send(formData);

        }else{
            if(usernameAlert.innertText !== ""){
                usernameAlert.innerText = "";
                usernameAlert.className = "alert-hide";
            }
            confirmPasswordAlert.innerText = "Password dan konfirmasi password tidak sesuai!";
            confirmPasswordAlert.className = "alert-show";
        }
    })
})