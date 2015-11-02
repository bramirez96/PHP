//main.js main functions for thingamajig

/**
* loadUsers() loads stored JSON strings and parses them into objects
* Eventually move this to a game-specific file
*/
function loadUsers() {
	if (localStorage.user) var z = localStorage.user;
	else z = '{"keys":[]}';
	usr = JSON.parse(z);
}
document.addEventListener(onload, loadUsers());
function logOut() {
	sessionStorage.clear();
	alert("You will now be returned to the login screen.");
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