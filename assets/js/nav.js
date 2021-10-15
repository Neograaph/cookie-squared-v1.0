console.log('annimation nav burger');
let navStatus = false;
document.getElementById('navShow').addEventListener('click', function () {
  navStatus = !navStatus;
  console.log(navStatus);
})