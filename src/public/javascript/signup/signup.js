document.addEventListener("DOMContentLoaded", (e) => {
    const fullnameInput = document.getElementById('fullname');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const passwordConfirmedInput = document.getElementById('confirm-password');
    const registrationForm = document.getElementById('form-registration');
    const adminButton = document.getElementById('admin-radio');
    const userButton = document.getElementById('user-radio');

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

            xhr.open("POST", "http://localhost:8080/public/signup", true);
            console.log("makan enak");
            xhr.onload = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 201) {
                        const data = JSON.parse(xhr.responseText);
                        location.replace(data.redirect_url);
                        console.log("APA");
                    }
                }
            }
            xhr.send(formData);

        }else{
            alert("konfirmasi password salah anjay");
        }
    })
})