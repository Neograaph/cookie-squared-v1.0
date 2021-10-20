
let cookiebanner = document.getElementById('cookiebanner');
let cookie = document.getElementById('cookie');
let all = document.getElementById('all');
let aside = document.getElementById('aside');



document.getElementById('cookie').addEventListener('click', function () {
   cookiebanner.style.display="block";
   cookie.style.display="none";
   all.style.display="block";
});

window.addEventListener('click', function (event) {
    if (event.target == document.getElementById('all')){
        cookiebanner.style.display = "none";
        all.style.display="none";
        cookie.style.display="block";
    }

})
