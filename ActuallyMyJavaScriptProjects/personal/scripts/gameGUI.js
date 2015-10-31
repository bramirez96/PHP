//gameGUI.js for use in game pages to automatically set up page
/**
* makeGUI() calls all GUI functions
*/
function makeGUI() {
	makeHeader();
	makeUserModule();
}
/**
* makeHeader() populates #headModule with menu items
*/
function makeHeader() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("headModule").innerHTML = xhttp.responseText;
    }
  }
  xhttp.open("GET", "./modules/headModule.html", true);
  xhttp.send();
}
/**
* makeUserModule() populates #userModule with user information
*/
function makeUserModule() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("userModule").innerHTML = xhttp.responseText;
    }
  }
  xhttp.open("GET", "./modules/userModule.html", true);
  xhttp.send();
}