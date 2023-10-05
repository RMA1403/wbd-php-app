document.addEventListener("DOMContentLoaded", (e) => {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const passwordConfirmedInput = document.getElementById('confirm-password');
    const registrationForm = document.getElementById('form-registration');

    registrationForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const password = passwordInput.value;
        const passwordConfirmed = passwordConfirmedInput.value;

        // validasi konfirmasi password
        if(password === passwordConfirmed){
            const username = usernameInput.value;

            const formData = new FormData();
            formData.append("username", username);
            formData.append("password", password);

            const xhr = new XMLHttpRequest();

            xhr.open("POST", "http://localhost:8080/public/signup", true);
            xhr.send(formData);

        }else{
            alert("password salah kon");
        }
    })
})