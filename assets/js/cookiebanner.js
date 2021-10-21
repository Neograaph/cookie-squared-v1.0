
let cookiebanner = document.getElementById('cookiebanner');
let cookie = document.getElementById('cookie');
let all = document.getElementById('all');
let aside = document.getElementById('aside');
let btnrefuse = document.getElementById('btnrefuse');
let btnpref = document.getElementById('btnpref');
let btnaccept = document.getElementById('btnaccept');
let cookiebanner2 = document.getElementById('cookiebanner2');
let cross = document.getElementById('cross');


// ----------banniere1-------------

document.getElementById('cookie').addEventListener('click', function () {
   cookiebanner.style.display="block";
   all.style.display="block";
});

window.addEventListener('click', function (event) {
    if (event.target == document.getElementById('all')){
        cookiebanner.style.display = "none";
        all.style.display="none";
    }
})

document.getElementById('cross').addEventListener('click', function () {
    cookiebanner.style.display = "none";
    all.style.display="none";
    // cookie.style.display="block";
 });


// --------banniere2-----------------

document.getElementById('btnrefuse').addEventListener('click', function () {
    cookie.style.display="block";
    cookiebanner2.style.display="none"
    all.style.display="none";

 });
 

document.getElementById('btnpref').addEventListener('click', function () {
    
    cookiebanner2.style.display="none"
    cookiebanner.style.display="block";
    cookie.style.display="none";
    all.style.display="block";
    


 });

document.getElementById('btnaccept').addEventListener('click', function () {
    cookie.style.display="block";
    cookiebanner2.style.display="none"
    all.style.display="none";


 });
