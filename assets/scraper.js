// requete
let cookiesList = document.getElementById('cookiesList');
let xhr = new XMLHttpRequest();

xhr.onreadystatechange = function() {
  console.log(this);
  if (this.readyState == 4 && this.status == 200) {
    cookiesList.innerHTML = JSON.stringify(this.response);
  } else if (this.readyState == 4 && this.status == 404) {
    alert ('Erreur 404 :/');
  }
}

xhr.open('GET', "https://cookiesquared.codecolliders.dev/request", true);
xhr.responseType = "json";
xhr.send();