console.log('annimation nav burger');
let navStatus = false;
document.getElementById('navClose').style.display="none";

document.getElementById('navShow').addEventListener('click', function () {
  navStatus = !navStatus;
  console.log(navStatus);
  document.getElementById('navShow').style.display="none";
  document.getElementById('navClose').style.display="block";
});

document.getElementById('navClose').addEventListener('click', function () {
  navStatus = !navStatus;
  console.log(navStatus);
  document.getElementById('navShow').style.display="block";
  document.getElementById('navClose').style.display="none";
});