const profile = document.querySelector('.profile');
const profileMenu = document.querySelector('.profile-menu');

console.log("masokkdf");
profile && 
    profile.addEventListener('click', (e) => {
        profileMenu.style.display = 'flex'; 
});
    
window.addEventListener('click', function(e){   
    if (!profileMenu.contains(e.target) && !profile.contains(e.target)){
        profileMenu.style.display = 'none'; 
    } 
});


const editProfile = document.querySelector('.edit-profile-back');
const menuProfile = document.getElementById('menu-profile');
const editSection = document.querySelector('.edit-profile-container');

menuProfile &&
    menuProfile.addEventListener('click', (e) => {
        console.log("keklik cok");
        editProfile.style.display = 'flex';
});

window.addEventListener('click', function(e){   
    if (!editSection.contains(e.target) && !menuProfile.contains(e.target)){
        editProfile.style.display = 'none'; 
    } 
});