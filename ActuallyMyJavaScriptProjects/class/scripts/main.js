//main.js main functions for thingamajig

/**
* loadUsers() loads stored JSON strings and parses them into objects
* Eventually move this to a game-specific file
*/
var loggedIn;
function loadUsers() {
	if (typeof localStorage.user !== "undefined") var z = localStorage.user;
	else z = '{"keys":[]}';
	usr = JSON.parse(z);
	//Takes form data from login module and pushes to session variable
	//then it should reload the index page to get rid of it.... I guess
	if (location.href.indexOf("?") > -1) {
		var login = new Object();
		var url = location.href;
		var info = url.split("?");
		var data = info[1].split("&");
		for (var i = 0; i < data.length; i++) {
			var x = data[i].split("=");
			login[x[0]] = x[1];
		}
		//This line logs in the user if valid credentials were entered
		sessionStorage.user = login["user"];
	}
	//Checks if user is logged in when form data wasn't entered
	if (typeof sessionStorage.user !== "undefined") {
		loggedIn = true;
	} else {
		loggedIn = false;
	}
	userModule();
}
window.onload = loadUsers;
/**
* userModule() is meant to be called on the login/user module
* it populates the element with the needed tags depending on var loggedIn
*/
function userModule() {
	if (!document.getElementById("userModule")) return;
	if (loggedIn) { //What to do if user is logged in
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		  if (xhttp.readyState == 4 && xhttp.status == 200) {
		    document.getElementById("userModule").innerHTML = xhttp.responseText;
		  }
		}
		xhttp.open("GET", "./modules/userModule.html", true);
		xhttp.send();
		document.body.onload = checkUserModule();
	} else { //What to do if user ISN'T logged in
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		  if (xhttp.readyState == 4 && xhttp.status == 200) {
		    document.getElementById("userModule").innerHTML = xhttp.responseText;
		  }
		}
		xhttp.open("GET", "./modules/loginModule.html", true);
		xhttp.send();
	}
}
/**
* Hacks for days
* code from sxnine on StackOverflow
* //stackoverflow.com/questions/23661304/how-to-execute-a-function-in-javascript-after-an-html-element-is-loaded-via-ajax
*/
function afterLoad() {
	document.getElementById("uName").innerHTML = sessionStorage.user;
}
function checkUserModule() {
	var interval = setInterval(function() {
			if (document.getElementById("uName")) {
				clearInterval(interval);
				afterLoad();
			}
		}, 1)
}
/**
* Just a rough logout procedure for testing purposes
*/
function logOut() {
	sessionStorage.clear();
	window.location.assign("./index.html");
}
/**
* checkLoginForm() stops form submit and displays errors 
* if invalid username or password are submitted
*/
function checkLoginForm(form) {
	x = form.elements["user"].value;
	y = form.elements["pass"].value;
	document.getElementById("passError").style.display="none";
	document.getElementById("userError").style.display="none";
	if (usr[x]) {//If storage item exists
		//alert("username exists");
		if ((usr[x]["pass"]) == y){//Check the password
			//alert("and your password is right");
			return true;
		} else {
			document.getElementById("passError").style.display="inline";
			//alert("but your password is wrong");
			return false;
		}
	} else {
		//alert("username doesnt exist");
		document.getElementById("userError").style.display="inline";
		document.getElementById("passError").style.display="inline";
		return false;
	}
}
/**
* checkSignupForm() stops form submit and displays errors
* if username is taken already or passwords don't match
*/
function checkSignupForm(form) {
	x = form.elements["user"].value;
	y = form.elements["pass"].value;
	z = form.elements["pVer"].value;
	document.getElementById("userError").style.display="none";
	document.getElementById("passError").style.display="none";
	document.getElementById("nullError").style.display="none";
	if (usr[x] == null) { //If username isn't taken
		if (y != "") {
			if (y == z) {
				return true;
			} else {
				document.getElementById("passError").style.display="inline";
				return false;
			}
		} else {
			document.getElementById("nullError").style.display="inline";
			return false;
		}
	} else {
		document.getElementById("userError").style.display="inline";
		if (y == "") {
			document.getElementById("nullError").style.display="inline";
		}
		if (y != z) {
			document.getElementById("passError").style.display="inline";
		}
		return false;
	}
}