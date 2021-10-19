// console.log('annimation nav burger');
let navStatus = false;
let navOpen = false;
// display none au chargement de la page
// document.getElementById('navClose').style.display="none";
// document.getElementById('navOpen').style.display="block";

// events pour masquer/afficher au click
document.getElementById('navShow').addEventListener('click', function () {
  navStatus = !navStatus;
  console.log(navStatus);
  document.getElementById('navShow').style.display="none";
  document.getElementById('navClose').style.display="block";
  document.getElementById('navOpen').style.display="block";
  document.getElementById('main').style.display="none";
  document.getElementById('footer').style.display="none";

});

document.getElementById('navClose').addEventListener('click', function () {
  navStatus = !navStatus;
  console.log(navStatus);
  document.getElementById('navShow').style.display="block";
  document.getElementById('navClose').style.display="none";
  document.getElementById('navOpen').style.display="none";
  document.getElementById('main').style.display="block";
  document.getElementById('footer').style.display="block";
});

document.getElementsByClassName('link')[0].addEventListener('click', function(){hide()});
document.getElementsByClassName('link')[1].addEventListener('click', function(){hide()});
document.getElementsByClassName('link')[2].addEventListener('click', function(){hide()});
document.getElementsByClassName('link')[3].addEventListener('click', function(){hide()});

function hide () {
  document.getElementById('navShow').style.display="block";
  document.getElementById('navClose').style.display="none";
  document.getElementById('navOpen').style.display="none";
  document.getElementById('main').style.display="block";
  document.getElementById('footer').style.display="block";
}