
let cookiebanner = document.getElementById('cookiebanner');
// let main = document.getElementById('main');
// let nav = document.getElementById('nav');
// let footer = document.getElementById('footer');
let all = document.getElementById('all');
let aside = document.getElementById('aside');
let showPopup = false;
console.log(showPopup);


document.getElementById('cookie').addEventListener('click', function () {
   console.log("clique cookie");
   document.getElementById('cookiebanner').style.display="block";
   document.getElementById('cookie').style.display="none";
   all.style.display="block";
   showPopup = true;
   console.log(showPopup);
});
window.addEventListener('click', function (event) {
    if (event.target == document.getElementById('all')){
        cookiebanner.style.display = "none";
        showPopup = false;
        console.log(showPopup);
        document.getElementById('all').style.display="none";
        document.getElementById('cookie').style.display="block";
    }

})
// if (showPopup == true){
//     // test ();
//     console.log('condition true ');
// }

// // function test () {
//         window.onclick = function(event) {
//         console.log(showPopup);
//         console.log('here');
//         console.log(event.target);
//     }
// }
// };
  // if (event.target == document.getElementById('footer')){
      //   cookiebanner.style.display = "none";
      //   console.log("test");
      // };
      
      // if (event.target == nav){
          //   cookiebanner.style.display = "none";
          // };

