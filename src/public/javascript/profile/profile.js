const profile = document.querySelector(".profile");
const profileMenu = document.querySelector(".profile-menu");
const SaveProfileAlert = document.getElementById("save-profile-alert");

profile &&
  profile.addEventListener("click", (e) => {
    profileMenu.style.display = "flex";
  });

window.addEventListener("click", function (e) {
  if (!profileMenu.contains(e.target) && !profile.contains(e.target)) {
    profileMenu.style.display = "none";
  }
});

const editProfile = document.querySelector(".edit-profile-back");
const menuProfile = document.getElementById("menu-profile");
const editSection = document.querySelector(".edit-profile-container");

menuProfile &&
  menuProfile.addEventListener("click", (e) => {
    editProfile.style.display = "flex";
  });

window.addEventListener("click", function (e) {
  if (!editSection.contains(e.target) && !menuProfile.contains(e.target)) {
    editProfile.style.display = "none";
    SaveProfileAlert.innerHTML = "";
  }
});


// Handle submit
const nameForm = document.getElementById("name-form");
const usernameForm = document.getElementById("username-form");
const submitProfileButton = document.getElementById("submit-profile");

submitProfileButton.addEventListener("click", (e) => {
  e.preventDefault();
  const name = nameForm.value;
  const username = usernameForm.value;

  const formData = new FormData();
  formData.append("name", name);
  formData.append("username", username);

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/public/profile", true);

  xhr.onload = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        nameForm.value = JSON.parse(xhr.responseText).name;
        usernameForm.value = JSON.parse(xhr.responseText).username;
        SaveProfileAlert.style.color = "green";
        SaveProfileAlert.innerHTML = JSON.parse(xhr.responseText).message;      
      } else {
        SaveProfileAlert.style.color = "red";
        SaveProfileAlert.innerHTML = JSON.parse(xhr.responseText).message;
      }
    }
  };

  xhr.send(formData);
});





