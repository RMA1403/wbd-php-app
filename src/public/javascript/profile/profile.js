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