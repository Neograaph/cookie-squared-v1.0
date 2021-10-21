
let cookiebanner = document.getElementById('cookiebanner');
let cookie = document.getElementById('cookie');
let all = document.getElementById('all');
let aside = document.getElementById('aside');
let btnrefuse = document.getElementById('btnrefuse');
let btnpref = document.getElementById('btnpref');
let btnaccept = document.getElementById('btnaccept');
let cookiebanner2 = document.getElementById('cookiebanner2');
let cross = document.getElementById('cross');
let btnvalidcookies = document.getElementById('btnvalidcookies');






// ----------banniere1-------------


cookie.addEventListener('click', function () {
   cookiebanner.style.display="block";
   all.style.display="block";
   cookie.style.display="none"
});

window.addEventListener('click', function (event) {
    if (event.target == document.getElementById('all')){
        cookiebanner.style.display = "none";
        all.style.display="none";
        cookie.style.display="block";
        cookiebanner.style.display="none";     
        console.log(document.cookie);
    }
})

cross.addEventListener('click', function () {
    cookiebanner.style.display = "none";
    all.style.display="none";
    cookie.style.display="block";
    
 });

btnvalidcookies.addEventListener('click', function(){
    cookiebanner.style.display="none";
    all.style.display="none";
    cookie.style.display="block";
    document.cookie="boolcookie=true; path=/; SameSite=Strict";
    console.log(document.cookie);
})


// --------banniere2-----------------

btnrefuse.addEventListener('click', function () {
    cookie.style.display="block";
    cookiebanner2.style.display="none"
    all.style.display="none";
    document.cookie="boolcookie=true; path=/; SameSite=Strict";
    console.log(document.cookie);
 });
 

btnpref.addEventListener('click', function () {
    
    cookiebanner2.style.display="none"
    cookiebanner.style.display="block";
    cookie.style.display="none";
    all.style.display="block";
    


 });

btnaccept.addEventListener('click', function () {
    cookie.style.display="block";
    cookiebanner2.style.display="none"
    all.style.display="none";
    document.cookie="boolcookie=true; path=/; SameSite=Strict";
    console.log(document.cookie);
    
 });



//  ---------------ne pas afficher le bandeau si cookies deja choisis------------




if('boolcookie=true'){
    cookiebanner2.style.display="none"
    all.style.display="none";
    cookie.style.display="block";
}

